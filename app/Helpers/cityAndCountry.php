<?php

function cityAndCountry($city, $country) {
    $output = '';

    $city = trim(strip_tags($city));
    $country = trim(strip_tags($country));

    if ($city && !$country) {
        $output = $city;
    }

    if ($country && !$city) {
        $output = $country;
    }

    if ($city && $country) {
        $output = $city . ', ' . $country;
    }

    if ( (strlen($city) + strlen($country)) > 23 ) {
        $output = $city . "<br>" . $country;
    }

    return  $output;
}
