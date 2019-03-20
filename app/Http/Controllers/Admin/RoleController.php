<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function users()
    {
        return view('admin.roles.users');
    }

    public function admins()
    {
        return view('admin.roles.admins');
    }
}
