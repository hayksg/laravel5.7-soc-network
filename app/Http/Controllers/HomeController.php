<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user    = false;
        $profile = false;
        $page    = 'main';

        if (Auth::check()) {
            $user    = Auth::user();
            $profile = $user->profile;
        }

        return view('index', compact('user', 'profile', 'page'));
    }
}
