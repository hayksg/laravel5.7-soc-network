<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Status;
use Vinkla\Hashids\Facades\Hashids;

class StatusController extends Controller
{
    public function index()
    {
        /* if (auth()->check()) {
            $statuses = Status::where(function($query) {
                return $query->where('user_id', auth()->id())
                             ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            })->orderBy('created_at', 'desc')->get();
        } */

        $user = auth()->user();
        $statuses = Status::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('statuses.index', compact('user', 'statuses'));
    }

    public function postStatus()
    {
        $this->validate(request(), [
            'status' => 'required|max:1000',
            'image'   => 'image|max:2000',
        ]);

        if (request()->hasFile('image')) {
            $fileName = basename(request()->file('image')->store('public/status-images')); // save in the file system
            $requestData['image'] = $fileName; // for save in the database
        }

        $requestData['body'] = request('status');
        $requestData['user_id'] = auth()->id();

        Status::create($requestData);

        return back()->withUser(auth()->user());
    }

    public function getStatus($id, $slug)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);
        
        if (!$user || $user->slug != $slug) {
            return abort(404);
        }

        $statuses = Status::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('statuses.index', compact('user', 'statuses'));
    }
}
