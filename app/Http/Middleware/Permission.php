<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Deactivate kora user age theke login thakleo sathe sathe logout hoye jabe
        if ($request->user() && $request->user()->is_active === false) {
            auth()->guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            notify()->error('Your account has been deactivated. Please contact the administrator.');

            return redirect()->route('login');
        }

        if ($request->route()->getName() === 'dashboard') {
            return $next($request);
        }

        $routeName = $request->route()->getName();
        if (! $routeName) {
            return $next($request);
        }

        if ($request->user()->hasRole('Super Admin')) {
            return $next($request);
        }

        $user = $request->user();

        // Exact permission
        if ($user->can($routeName)) {
            return $next($request);
        }

        [$module, $action] = array_pad(explode('.', $routeName, 2), 2, null);

        // Permission page only creates: index / create / edit / destroy / status.
        // So map the other route actions onto those permissions:
        //   store -> create, update -> edit, show -> index,
        //   recycleBin/restore/forceDelete -> destroy
        $actionMap = [
            'store'             => 'create',
            'update'            => 'edit',
            'show'              => 'index',
            'toggleStatus'      => 'status',   // user activate / deactivate
            'addPermission'     => 'edit',     // Role -> Add Permission page
            'permissions.store' => 'edit',     // Role -> Add Permission save
            'recycleBin'        => 'destroy',
            'restore'           => 'destroy',
            'forceDelete'       => 'destroy',
        ];

        if ($module && isset($actionMap[$action]) && $user->can($module . '.' . $actionMap[$action])) {
            return $next($request);
        }

        notify()->error('You do not have permission to access this page');
        return redirect()->route('dashboard');
    }

}