<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminRoleController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        $cnt = 0;

        return view('admin.admin-role.index', compact('admins', 'cnt'));
    }

    public function edit(User $admin)
    {
        return view('admin.admin-role.edit', compact('admin'));
    }

    public function update(User $admin)
    {
        $roleAdmin = (bool) request('role');

        if ($roleAdmin) {
            $admin->role = 'admin';
        } else {
            $admin->role = 'user';
        }

        $admin->update();

        return response()->json([
            'role' => $admin->role,         
        ]);
    }
}
