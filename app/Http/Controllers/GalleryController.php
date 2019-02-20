<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gallery;
use Vinkla\Hashids\Facades\Hashids;

class GalleryController extends Controller
{
    public function index($id, $slug)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);
        
        if (!$user || $user->slug != $slug) {
            return abort(404);
        }

        if(!isGalleryAccessible($user)) {
            return abort(404); // private gallery
        }
                                            
        $gallery = Gallery::where('user_id', $user->id)->get();

        return view('gallery.index', compact('gallery'));
    }
}
