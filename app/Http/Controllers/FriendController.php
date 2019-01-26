<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends();
        return view('friends.index', compact('friends'));
    }

    public function findFriends()
    {
        $userId = Auth::user()->id;
        $allFriends = User::with('profile')->where('id', '!=', $userId)->get();
        //$allFriends = DB::table('users')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('users.id', '!=', $userId)->get();

        return view('friends.find-friends', compact('allFriends'));
    }

    public function requests()
    {
        $requests = Auth::user()->friendRequests();
        return view('friends.requests', compact('requests'));
    }

    public function add(User $user)
    {
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->back()->with(['id' => Hashids::encode($user->id), 'slug' => $user->slug]);
        }

        if (Auth::user()->id === $user->id) {
            return redirect()->route('home');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect()->back()->with(['id' => Hashids::encode($user->id), 'slug' => $user->slug]);
        }

        Auth::user()->addFriend($user);
        return redirect()->back()->with(['id' => Hashids::encode($user->id), 'slug' => $user->slug]);
    }

    public function accept(User $user)
    {
        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()->back()->with(['id' => Hashids::encode($user->id), 'slug' => $user->slug]);
    }

    public function delete(User $user)
    {
        if (!Auth::user()->isFriendsWith($user)) {
            return redirect()->back();
        }
        
        Auth::user()->deleteFriend($user);
        return redirect()->back();
    }
}
