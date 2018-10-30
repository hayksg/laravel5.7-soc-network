<?php

function onlyName() {
    $name = Auth::user()->name;
    $output = substr($name, 0, strpos($name, ' '));
    return $output;
}
