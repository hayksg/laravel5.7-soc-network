<?php

function onlyName($lowercase = true) {
    $name = Auth::user()->name;
    $output = substr($name, 0, strpos($name, ' '));

    if ($lowercase) {
        return strtolower($output);
    }
    return $output;
}
