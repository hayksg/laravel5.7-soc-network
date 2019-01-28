<?php

function shortName($name, $lettersCnt = 10) {
    $name = trim(strip_tags($name));
    $output = '';

    if (strlen($name) > $lettersCnt) {
        $shortName = ucwords(substr($name, 0, $lettersCnt)) . '...';
        $output = '<span data-toggle="tooltip" data-placement="right" title="' . $name . '">' . $shortName . '</span>';
    } else {
        $output = '<span>' . $name . '</span>';
    }

    return $output;
}
