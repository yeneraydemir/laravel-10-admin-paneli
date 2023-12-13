<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
// UserController.php

public function index() {
    $users = User::paginate(15);
    return view('admin.users.index', compact('users'));
}
public function show(User $user) {
    $roles = Role::get();
    $user_permissions = $user->getAllPermissions()->pluck('name')->toArray();
    $user_roles = $user->getRoleNames()->toArray();

    return view('admin.users.show', compact('user', 'roles', 'user_permissions', 'user_roles'));
}

public function updatePermissions(Request $request, User $user) {
    $permissions =$request->get('permissions');
    $roles =$request->get('roles');

    $user->syncPermissions($permissions);
    $user->syncRoles($roles);

    return redirect()->back();
}
}