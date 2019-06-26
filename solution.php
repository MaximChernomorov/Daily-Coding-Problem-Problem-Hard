<?php

$k = 2;

$inputs = [
    'abc', //false
    'kgbbgk', //true
    'waterrfetawx', //true
    'madam', //true
    'kgbbgjk', //true
    'kfdgbbgak', //false
    'jhkakhjds', //true
    'jahkakhsjb' // true if k=3, false if k=2
];


function isPalindromeWithDeletions(string $string, int $deletionCount = 1): bool {
    if (isPalindrome($string)) {
        return true;
    }

    $arString = str_split($string);
    $stringLength = count($arString);
    $minLetterCount = $stringLength - $deletionCount;
    $minLetterCount = $minLetterCount < 2 ? 2 : $minLetterCount;
    $r = [$string];
    getCombinations($arString, $r, $minLetterCount);
    
    foreach ($r as $substring) {
        if (isPalindrome($substring)) {
            echo 'found substring polindrome "' . $substring . '"';echo PHP_EOL;
            return true;
        }   
    }
    return false;
}

function getCombinations($arString, &$results, $min) {
    if (count($arString) < $min) {
        return [];
    }
    foreach ($arString as $k => $v) {
        $c = $arString;
        unset($c[$k]);
        if (count($c) < $min) {
            return [];
        }
        
        $results[] = implode('',$c);
        getCombinations($c, $results, $min);
    }

    return $results;
}

function isPalindrome(string $string): bool {
    if ($string === strrev($string)) {
        return true;
    }
    return false;
}

$results = [];
foreach ($inputs as $input) {
    $results[$input] = isPalindromeWithDeletions($input, $k);
}

var_dump($results);