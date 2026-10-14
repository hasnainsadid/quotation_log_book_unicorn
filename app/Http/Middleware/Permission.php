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

        // 🔥 Destroy permission controls recycle features
        $destroyMappedRoutes = ['recycleBin', 'restore', 'forceDelete'];

        [$module, $action] = array_pad(explode('.', $routeName, 2), 2, null);

        if ($module && in_array($action, $destroyMappedRoutes) && $user->can($module . '.destroy')) {
            return $next($request);
        }

        notify()->error('You do not have permission to access this page');
        return redirect()->route('dashboard');
    }

}
