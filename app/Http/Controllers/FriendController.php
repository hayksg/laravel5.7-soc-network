<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends();
        return view('friends.index', compact('friends'));
    }

    public function requests()
    {
        $requests = Auth::user()->friendRequests();
        return view('friends.requests', compact('requests'));
    }

    public function add(User $user)
    {
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->route('getWithSlug', ['id' => $user->id, 'slug' => $user->slug]);
        }

        if (Auth::user()->id === $user->id) {
            return redirect()->route('home');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect()->route('getWithSlug', ['id' => $user->id, 'slug' => $user->slug]);
        }

        Auth::user()->addFriend($user);
        return redirect()->route('getWithSlug', ['id' => $user->id, 'slug' => $user->slug]);
    }

    public function accept(User $user)
    {
        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()->route('getWithSlug', ['id' => $user->id, 'slug' => $user->slug]);
    }
 
    
}
