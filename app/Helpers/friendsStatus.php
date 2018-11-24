<?php

function friendsStatus($id) {
    $output = '';
    $result = \App\Friendship::where('requester', '=', Auth::user()->id)->where('user_requested', '=',  $id)->first();

    if ($result) {
        
        if ($result->status == 0) {
            $output = 'pending';
        } else if ($result->status == 1) {
            $output = 'friends';
        }
    }

    return $output;
}
