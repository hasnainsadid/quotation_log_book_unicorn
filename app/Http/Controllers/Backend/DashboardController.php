<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\QuatationLogBook;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $showUsers      = hasPermission(['users.index']);
        $showRoles      = hasPermission(['roles.index']);
        $showQuotations = hasPermission(['quatation-log-books.index']);
        $canViewAll     = QuatationLogBook::canViewAll();

        $stats = [
            'users' => $showUsers ? User::count() : 0,
            'roles' => $showRoles ? Role::count() : 0,
        ];

        // Role-wise user count (withCount ব্যবহার না করে raw subquery, তাই Spatie relation লাগে না)
        $roleBreakdown = collect();
        $recentUsers   = collect();

        if ($showUsers) {
            $roleBreakdown = Role::all()->map(function ($role) {
                $role->users_count = User::role($role->name)->count();
                return $role;
            })->sortByDesc('users_count')->values();

            $recentUsers = User::with('roles')->latest()->take(5)->get();
        }

        $quotation = null;

        if ($showQuotations) {
            $base = fn() => QuatationLogBook::visible();

            // শেষ ৬ মাসের চার্ট (PHP-তে group করা হয়েছে, তাই যেকোনো ডাটাবেসে চলবে)
            $start  = now()->startOfMonth()->subMonths(5);
            $counts = $base()
                ->where('created_at', '>=', $start)
                ->get(['created_at'])
                ->groupBy(fn($r) => $r->created_at->format('Y-m'));

            $months = collect(range(0, 5))->map(function ($i) use ($start, $counts) {
                $m = $start->copy()->addMonths($i);

                return [
                    'label' => $m->format('M'),
                    'total' => $counts->get($m->format('Y-m'), collect())->count(),
                ];
            });

            $quotation = [
                'total'      => $base()->count(),
                'this_month' => $base()->where('created_at', '>=', now()->startOfMonth())->count(),
                'lifts'      => (int) $base()->sum('lift_quantity'),
                'trashed'    => $base()->onlyTrashed()->count(),
                'months'     => $months,
                'max'        => max(1, $months->max('total')),
                'recent'     => $base()->with('pqUser')->latest()->take(5)->get(),
                'by_user'    => $canViewAll
                    ? $base()
                    ->selectRaw('pq_user_id, COUNT(*) as total')
                    ->whereNotNull('pq_user_id')
                    ->groupBy('pq_user_id')
                    ->with('pqUser:id,name')
                    ->orderByDesc('total')
                    ->take(5)
                    ->get()
                    : collect(),
            ];
        }

        return view('backend.pages.dashboard.index', compact(
            'stats', 'roleBreakdown', 'recentUsers', 'quotation',
            'showUsers', 'showRoles', 'showQuotations', 'canViewAll'
        ));
    }
}
