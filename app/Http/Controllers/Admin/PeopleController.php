<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    public function users()
    {
        return view('admin.people.users');
    }

    public function admins()
    {
        return view('admin.people.admins');
    }
}
