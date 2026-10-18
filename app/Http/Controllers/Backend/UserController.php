<?php
namespace App\Http\Controllers\Backend;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Mail\UserCredentialsMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('backend.pages.users.index');
    }

    /**
     * Store a newly created resource in storage.
     * Password auto-generate হয় এবং ইমেইলে পাঠানো হয়।
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required|unique:users,phone',
            'designation' => 'required|string|max:100',
            'address'     => 'required|string',
            'role'        => 'required|exists:roles,name',
        ]);

        $password = Str::password(10, symbols: false); // letters + numbers

        try {
            // ইমেইল ফেল করলে পুরো কাজ rollback হবে, ইউজার তৈরি হবে না
            DB::transaction(function () use ($data, $password) {
                $user = User::create([
                    'name'        => $data['name'],
                    'email'       => $data['email'],
                    'phone'       => $data['phone'],
                    'designation' => $data['designation'],
                    'address'     => $data['address'],
                    'password'    => Hash::make($password),
                ]);

                $user->assignRole($data['role']);

                Mail::to($user->email)->send(new UserCredentialsMail($user, $password));
            });
        } catch (\Throwable $e) {
            report($e);
            notify()->error('User was not created because the email could not be sent. Check the mail settings.');
            return redirect()->route('users.index');
        }

        notify()->success('User created and login details sent to the email');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user  = User::with('roles')->findOrFail($id);
        $roles = Role::pluck('name');

        return response()->json([
            'user'  => $user,
            'role'  => $user->roles->pluck('name')->first(), // single role
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'phone'       => 'required|unique:users,phone,' . $user->id,
            'designation' => 'required|string|max:100',
            'address'     => 'required|string',
            'role'        => 'required|exists:roles,name',
        ]);

        $user->update([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'],
            'designation' => $data['designation'],
            'address'     => $data['address'],
        ]);

        // Replace old role
        $user->syncRoles([$data['role']]);

        notify()->success('User updated successfully');
        return redirect()->route('users.index');
    }

    /**
     * Activate / deactivate a user.
     * Deactivated user login korte parbe na.
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {
            notify()->error('You cannot deactivate your own account');
            return redirect()->route('users.index');
        }

        if ($user->hasRole('Super Admin')) {
            notify()->error('Super Admin cannot be deactivated');
            return redirect()->route('users.index');
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        if (! $user->is_active) {
            $user->tokens()->delete(); // API token thakle bondho
        }

        notify()->success($user->is_active ? 'User activated successfully' : 'User deactivated successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Remove roles & permissions (important)
        $user->syncRoles([]);
        $user->syncPermissions([]);

        // Delete user
        $user->delete();

        notify()->success('User deleted successfully');
        return redirect()->route('users.index');
    }
}