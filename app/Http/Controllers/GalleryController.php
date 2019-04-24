<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Storage;

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
                                            
        $gallery = Gallery::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('gallery.index', compact('gallery', 'user'));
    }

    public function all($id)
    {                                 
        $galleryCount = Gallery::where('user_id', $id)->get()->count();

        return response()->json([
            'galleryCount' => $galleryCount,
        ]); 
    }

    public function add(Request $request)
    {
        if ($request->id) {
            $userId = abs((int)$request->id);
        }

        if (auth()->user()->id !== $userId) {
            return abort(404);
        }

        if (count($request->images)) {
            foreach ($request->images as $image) {
                $milliseconds = round(microtime(true) * 1000);
                $name = $milliseconds . $userId . $image->getClientOriginalName();
              
                $image->storeAs('public/gallery', $name);

                $res = Gallery::create([
                    'user_id' => $userId,
                    'image' => $name,
                ]);
            }
        } 

        $gallery = Gallery::where('user_id', $userId)->orderBy('created_at', 'desc')->get()->toArray();

        return response()->json([
            'res' => $res ? 'Ok' : 'Error',
            'gallery' => $gallery,
        ]); 

    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $id = abs((int)$request->id);
        }

        $gallery = Gallery::find($id);

        if (!$gallery) {
            return abort(404);
        }

        $userId = auth()->user()->id;
       
        if ($userId != $gallery->user_id) {
            return abort(404);
        }

        Storage::delete('public/gallery/' . $gallery->image);
        $gallery->delete();

        $gallery = Gallery::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
            
        return response()->json([
            'result' => 'OK',
            'gallery' => $gallery,
        ]); 
    }
}
