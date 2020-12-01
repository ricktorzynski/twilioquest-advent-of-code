<?php


$entries = [];

$entries = file("input.txt", FILE_IGNORE_NEW_LINES);

$entries2 = $entries;
$entries3 = $entries;

for ($i = 0; $i < count($entries); $i++) {
    for ($j = 0; $j < count($entries2); $j++) {
        for ($k = 0; $k < count($entries3); $k++) {
            if (($entries[$i] + $entries2[$j] + $entries3[$k] == 2020) && ($i !== $j && $i !== $k && $j !== $k)) {
                print "entry " . $entries[$i] . " + entry " . $entries[$j] . " + entry " . $entries[$k] . " = 2020\n";
                print "product is: " . $entries[$i] * $entries2[$j] * $entries3[$k] . "\n";
            }
        }
    }
}
