<?php

function onlyName($name, $lowercase = true) {
    if ($name) {
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
