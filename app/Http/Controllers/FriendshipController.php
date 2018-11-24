<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Friendship;
use App\User;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $friendId = abs((int)$request->id);
        $userId   = abs((int)Auth::user()->id);

        Friendship::create([
            'requester' => $userId,
            'user_requested' => $friendId,
        ]);

        //return redirect()->route('getWithSlug', [Auth::user()->slug]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findFriends()
    {
        $userId = Auth::user()->id;
        $allFriends = User::with('profile')->where('id', '!=', $userId)->get();
        //$allFriends = DB::table('users')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('users.id', '!=', $userId)->get();

        return view('friends.findFriends', compact('allFriends'));
    }
}
