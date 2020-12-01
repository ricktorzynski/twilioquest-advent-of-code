<?php


$entries = [];

$entries = file("input.txt", FILE_IGNORE_NEW_LINES);

$entries2 = $entries;

for ($i = 0; $i < count($entries); $i++) {
    for ($j = 0; $j < count($entries2); $j++) {
        if ( ($entries[$i] + $entries2[$j] == 2020) && ($i !== $j) ) {
            print "entry " . $entries[$i] . " + entry " . $entries[$j] . " = 2020\n";
            print "product is: " . $entries[$i] * $entries2[$j] . "\n";
        }
    }
}

