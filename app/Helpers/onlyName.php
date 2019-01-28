<?php

function onlyName($lowercase = true) {
    $name = Auth::user()->name;

    if (strpos($name, ' ')) {
        $name = substr($name, 0, strpos($name, ' '));
    }
    
    if ($lowercase) {
        return strtolower($name);
    }
    return $name;
}
