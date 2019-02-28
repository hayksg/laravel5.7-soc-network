<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Rules\PasswordsMatch;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Event;
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
        // Page not used
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Page not used
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Page not used
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Page not used
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {        
        $user = Auth::user();

        if ($slug !== Auth::user()->slug) {
            return abort(404);
        }

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
        $user = Auth::user();

        if ($id !== $user->id) {
            return abort(404);
        }

        $successMessage = 'Dear ' . $user->name . '! Your profile information successfully updated!';
        $sessionFlash = false;

        $this->validate(request(), [
            'city'            => 'nullable|regex:/^[^<>]*$/u|max:200',
            'country'         => 'nullable|regex:/^[^<>]*$/u|max:200',
            'about'           => 'nullable|regex:/^[^<>]*$/u',
            'image'           => 'image|max:3000',
            'private-gallery' => 'boolean',
        ]);

        if (request()->hasFile('image')) {

            $extension = request('image')->getClientOriginalExtension();
            $imageName = onlyName(Auth::user()->name) . '-' . $user->id . '.' . $extension;

            Storage::delete('public/users-images/' . $user->pic);

            $res = request('image')->storeAs('public/users-images', $imageName);

            if ($res) {
                $user->pic = $imageName;
                $sessionFlash = true;
                $user->update();
            }

        }

        $profile = Profile::where('user_id', $user->id)->firstOrFail();

        if ($profile) {

            $profile->city            = request('city') ? request('city') : '';
            $profile->country         = request('country') ? request('country') : '';
            $profile->about           = request('about') ? request('about') : '';
            $profile->private_gallery = request('private-gallery') ? 1 : 0;

            if($profile->isDirty()){
                // changes have been made
                $sessionFlash = true;
                $profile->update();
            }

        }
        
        if (request('new-password') || request('new-password_confirmation')) {

            $this->validate(request(), [
                'current-password' => ['required', new PasswordsMatch],
                'new-password' => ['required', 'string', 'min:6', 'confirmed', new OldAndNewPasswordsTheSame],
                'new-password_confirmation' => 'required',
            ]);

            $user->password = bcrypt(request('new-password'));

            if($user->isDirty()){
                // changes have been made
                $sessionFlash = true;
                $user->update();
            }
            
        }

        if ($sessionFlash) {
            session()->flash('message', $successMessage);
        }
        
        return redirect()->route('getWithSlug', ['id' => Hashids::encode(Auth::user()->id), 'slug' => Auth::user()->slug]);
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

        if ($id !== Auth::user()->id) {
            return abort(404);
        }

        if ($user) {
            Storage::delete('public/users-images/' . $user->pic);
            $user->delete();
            $profile->delete();
        }
        
        return redirect('/');
    }

    public function getWithSlug($id, $slug)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);
        
        if (!$user || $user->slug != $slug) {
            return abort(404);
        }

        return view('profile.index', compact('user'));
    }
}
