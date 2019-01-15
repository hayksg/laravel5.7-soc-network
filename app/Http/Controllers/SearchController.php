<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $searchString = trim(strip_tags(request('search')));
        
        return view('search.index', compact('searchString'));
    }
}
