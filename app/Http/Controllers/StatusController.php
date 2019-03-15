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
        $user = auth()->user();
        $statuses = Status::NotReply()->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        
        return view('statuses.index', compact('user', 'statuses'));
    }

    public function postStatus()
    {
        $this->validate(request(), [
            'status' => 'required|max:1000',
            'image'  => 'image|max:2000',
            'video'  => 'nullable|string|max:1000',
        ]);

        if (request()->hasFile('image')) {
            $fileName = basename(request()->file('image')->store('public/status-images')); // save in the file system
            $requestData['image'] = $fileName; // for save in the database
        }

        $requestData['body'] = request('status');
        $requestData['video_url'] = request('video');
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

        $statuses = Status::NotReply()->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('statuses.index', compact('user', 'statuses'));
    }

    public function postReply($statusId)
    {
        $this->validate(request(), [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
            "reply-{$statusId}.required" => 'The message field is required',
            "reply-{$statusId}.max" => 'The max length of the message is :max characters',
        ]);

        $statusId = abs((int)$statusId);
        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }

        if (!auth()->user()->isFriendsWith($status->user) && auth()-user()->id !== $status->user->id) {
            return redirect()->route('home');
        }

        $reply = Status::create([
            'body' => request("reply-{$statusId}"),
            'user_id' => auth()->user()->id
        ]);

        $status->replies()->save($reply);
        return back();
    }

    public function getLike($statusId)
    {
        $liked = false;
        $error = false;
        $likesCount = 0;

        $status = Status::find($statusId);

        if ($status) {
            $likesCount = $status->likes->count();
        }

        if (!$status) {
            $error = true;
        }

        if (!auth()->user()->isFriendsWith($status->user)) {
            $error = true;
        }

        if (auth()->user()->hasLikedStatus($status)) {
            $liked = true;
        }

        if (!$liked && !$error) {
            $like = $status->likes()->create(['user_id' => auth()->user()->id]);
            auth()->user()->likes()->save($like);
            
            $updatedStatus = Status::find($statusId);
            if ($updatedStatus) {
                $likesCount = $updatedStatus->likes->count();
            }
        }

        return response()->json([
            'likesCount' => $likesCount,
            'liked' => $liked
        ]);
    }
}
