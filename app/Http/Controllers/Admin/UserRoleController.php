<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        $cnt = 0;

        return view('admin.user-role.index', compact('users', 'cnt'));
    }

    public function edit(User $user)
    {
        return view('admin.user-role.edit', compact('user'));
    }

    public function update(User $user)
    {
        $roleAdmin = (bool) request('role');

        if ($roleAdmin) {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        $user->update();

        return response()->json([
            'role' => $user->role,         
        ]);
    }
}
