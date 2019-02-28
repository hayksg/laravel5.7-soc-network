<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public static function decodingFromJS($id)
    {
        /*
            We need this function to decrypt value from js (for user id in address bar)
        */
        $encoded = $id;   // encoded string from the request
        $decoded = '';
        for($i = 0; $i < strlen($encoded); $i++) {
            $b = ord($encoded[$i]);
            $a = $b ^ 118;  // must be same number used to encode the character
            $decoded .= chr($a);
        }

        return abs((int)str_replace('hi', '', $decoded));
    }
}
