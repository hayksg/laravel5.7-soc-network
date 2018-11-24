<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Rules\PasswordsMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\OldAndNewPasswordsTheSame;

class ProfileController extends Controller
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
        //
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
        $id = abs((int)$id);
        $user = User::find($id);
        $profile = $user->profile;
        return view('profile.edit', compact('user', 'profile'));
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
        $id = abs((int)$id);
        $user = User::find($id);
        $successMessage = 'Dear ' . $user->name . '! Your profile information successfully updated!';

        $this->validate(request(), [
            'city'    => 'nullable|regex:/^[^<>]*$/u|max:200',
            'country' => 'nullable|regex:/^[^<>]*$/u|max:200',
            'about'   => 'nullable|regex:/^[^<>]*$/u',
            'image'   => 'image|max:3000',
        ]);

        if (request()->hasFile('image')) {

            $extension = request('image')->getClientOriginalExtension();
            $imageName = onlyName() . '-' . $user->id . '.' . $extension;

            $foo = Storage::delete('public/users-images/' . $user->pic);

            $res = request('image')->storeAs('public/users-images', $imageName);

            if ($res) {
                $user->pic = $imageName;
                $user->update();
            }
        }

        $profile = Profile::where('user_id', $user->id)->firstOrFail();

        if ($profile) {

            $profile->city = request('city') ? request('city') : '';
            $profile->country = request('country') ? request('country') : '';
            $profile->about = request('about') ? request('about') : '';

            $profile->update();

        }
        
        if (request('current-password') || request('new-password') || request('new-password_confirmation')) {

            $this->validate(request(), [
                'current-password' => ['required', new PasswordsMatch],
                'new-password' => ['required', 'string', 'min:6', 'confirmed', new OldAndNewPasswordsTheSame],
                'new-password_confirmation' => 'required',
            ]);

            $user->password = bcrypt(request('new-password'));
            $user->save();
            
        }

        session()->flash('message', $successMessage);
        
        return redirect()->route('getWithSlug', ['id' => Auth::user()->id, 'slug' => Auth::user()->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = abs((int)$id);
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->firstOrFail();

        if ($user) {
            Storage::delete('public/users-images/' . $user->pic);
            $user->delete();
            $profile->delete();
        }
        
        return redirect('/');
    }

    public function getWithSlug($id, $slug)
    {
        $id = abs((int)$id);
        $user = User::find($id);
        $profile = $user->profile;

        return view('profile.index', compact('user', 'profile'));
    }
}





