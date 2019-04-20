<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Status;
use App\Like;
use App\Gallery;
use App\Profile;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        $cnt = 0;

        return view('admin.user-role.index', compact('users', 'cnt'));
    }

    public function edit(User $user)
    {
        return view('admin.user-role.edit', compact('user'));
    }

    public function update(User $user)
    {
        $roleAdmin = (bool) request('role');

        if ($roleAdmin) {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        $user->update();

        return response()->json([
            'role' => $user->role,         
        ]);
    }

    public function delete(User $user)
    {
        $statuses = Status::where('user_id', $user->id)->get();
        $role = $user->role;

        if ($statuses) {
            foreach ($statuses as $status) {
                if ($status->image) {
                    Storage::delete('public/status-images/' . $status->image);
                }
        
                Status::where('parent_id', $status->id)->delete();
                Like::where('likeable_id', $status->id)->delete();
        
                $status->delete();
            }
        }

        if ($user->pic) {
            Storage::delete('public/users-images/' . $user->pic);
        }

        $gallery = Gallery::where('user_id', $user->id)->get();

        foreach ($gallery as $item) {
            if ($item->image) {
                Storage::delete('public/gallery/' . $item->image);
            }
        }

        Gallery::where('user_id', $user->id)->delete();
        Profile::where('user_id', $user->id)->delete();

        $user->delete();
        
        session()->flash('success', 'Account successfully deleted!');

        if ($role === 'user') {
            return redirect()->action('Admin\UserRoleController@index');
        } else if ($role === 'admin') {
            return redirect()->action('Admin\AdminRoleController@index');
        }
    }
}
