<?php

function onlyName($lowercase = true) {
    if (Auth::user()) {
        $name = Auth::user()->name;

        if (strpos($name, ' ')) {
            $name = substr($name, 0, strpos($name, ' '));
        }
        
        if ($lowercase) {
            return strtolower($name);
        }
        return $name;
    }
    
    return false;
}
