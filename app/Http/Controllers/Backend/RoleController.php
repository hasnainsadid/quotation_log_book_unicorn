<?php
namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.roles.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name'       => $request->name,
            'guard_name' => 'web',
        ]);

        notify()->success('Role created successfully');
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        notify()->success('Role updated successfully');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addPermission($id)
    {
        $role   = Role::findOrFail($id);
        $routes = collect(Route::getRoutes())
            ->map(fn($route) => $route->getName())
            ->filter(function ($name) {
                return $name
                && ! str_contains($name, 'login')
                && ! str_contains($name, 'logout')
                && ! str_contains($name, 'password')
                && ! str_contains($name, 'profile')
                && ! str_contains($name, 'livewire')
                && ! str_contains($name, 'clear')
                && ! str_contains($name, 'composer')
                && ! str_contains($name, 'migration')
                && ! str_contains($name, 'iseed')
                && ! str_contains($name, 'register')
                && ! str_contains($name, 'boost.')
                && ! str_contains($name, 'two-factor.');
            })
            ->unique()
            ->sort()
            ->values();

        $permissions = [];

        foreach ($routes as $route) {
            // categories.edit → [categories, edit]
            [$module, $action] = array_pad(explode('.', $route, 2), 2, null);

            if (! $module || ! $action) {
                continue;
            }

            if (in_array($action, ['index', 'show'])) {
                $permissions[$module]['view'] = "$module.index";
            }

            if (in_array($action, ['create', 'store'])) {
                $permissions[$module]['create'] = "$module.create";
            }

            if (in_array($action, ['edit', 'update'])) {
                $permissions[$module]['edit'] = "$module.edit";
            }

            if (in_array($action, ['destroy', 'recycleBin', 'restore', 'forceDelete'])) {
                $permissions[$module]['destroy'] = "$module.destroy";
            }

        }

        foreach ($permissions as $module => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate([
                    'name'       => $permission,
                    'guard_name' => 'web',
                ]);
            }
        }

        return view('backend.pages.roles.add-permission', compact('role', 'permissions'));
    }

    public function permissionStore(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions ?: []);
        notify()->success('Permission added successfully');
        return redirect()->route('roles.index');
    }
}
