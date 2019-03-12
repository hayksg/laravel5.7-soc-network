<?php

function replaceForbiddenWords($userStr) {
    $output = '';
    $replacementArr = [];

    if ( \File::exists( \Storage::disk('public')->path('forbidden-words/text.txt') ) ) {
        $wordsFromStorage = \Storage::get('public/forbidden-words/text.txt');
    }

    if (!$wordsFromStorage) {
        return $userStr;
    }

    $wordsArr = explode(' ', $wordsFromStorage);

    foreach ($wordsArr as $word) {
        $asteriskCount = strlen($word) - 2;
        $asterisk = '';
        for ($i = 1; $i <= $asteriskCount; $i++) {
            $asterisk .= '*';
        }
        $firstLetter = $word[0];
        $lastLetter = substr($word, -1);
        $replacementArr[] = $firstLetter . $asterisk . $lastLetter;
    }

    $output = str_ireplace($wordsArr, $replacementArr, $userStr);
    
    return $output;
}
