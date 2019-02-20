<?php

function isGalleryAccessible($user) {
    $output = false;

    if (auth()->user()->id === $user->id) {
        $output = true;
    } else {
        if ($user->profile->private_gallery) {
            if (auth()->user()->isFriendsWith($user)) {
                $output = true;
            }
        } else {
            $output = true;
        }
    }

    return $output;
}
