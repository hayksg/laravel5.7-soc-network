<?php

namespace App\Http\Controllers;

use App\User;
use App\Search;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class SearchController extends Controller
{
    public function index()
    {
        $searchString = trim(strip_tags(request('search')));

        if (! empty($searchString)) {
            $minutes = 1;
            return User::cacheAllUsers(1);
        }
        return '';
    }

    public function selectedUser($id, $slug)
    {
        $id = Search::decodingFronJS($id);
        $user = User::find($id);
        
        if (!$user || $user->slug != $slug) {
            return abort(404);
        }

        $profile = $user->profile;

        return view('profile.index', compact('user', 'profile'));
    }
}
