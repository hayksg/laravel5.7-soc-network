<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ForbiddenWordsController extends Controller
{
    public function index()
    {
        $wordsFromStorage = $this->getWords();
        
        return view('admin.forbidden-words.index', compact('wordsFromStorage'));
    }

    public function add()
    {
        $this->validate(request(), [
            'words' => 'max:1000',
        ]);

        Storage::put('public/forbidden-words/text.txt', request('words'));

        $wordsFromStorage = $this->getWords();

        session()->flash('success', 'Data submitted successfully');
        return back()->with('wordsFromStorage', $wordsFromStorage);
    }

    private function getWords() {
        $wordsFromStorage = '';
        $output = '';

        if ( File::exists( Storage::disk('public')->path('forbidden-words/text.txt') ) ) {
            $wordsFromStorage = Storage::get('public/forbidden-words/text.txt');
        }

        if ($wordsFromStorage) {
            $wordsArr = explode(' ', $wordsFromStorage);
            sort($wordsArr, SORT_STRING);
            $output = implode(' ', $wordsArr);
        }
        
        return $output;
    }
}
