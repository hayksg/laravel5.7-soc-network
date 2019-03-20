<?php

namespace App\Http\Controllers\Admin;

use App\Status;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::NotReply()->get();
        $cnt = 0;

        return view('admin.statuses.index', compact('statuses', 'cnt'));
    }

    public function view($id)
    {
        $status = Status::NotReply()->find($id);

        return view('admin.statuses.view', compact('status'));
    }

    public function delete(Status $status)
    {
        if ($status) {
            if ($status->image) {
                Storage::delete('public/status-images/' . $status->image);
            }
    
            Status::where('parent_id', $status->id)->delete();
            Like::where('likeable_id', $status->id)->delete();
    
            $status->delete();
        }
        
        return redirect()->action('Admin\StatusController@index');
    }
}
