<?php
$valid_passwords = 0;
$count = 0;
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);

for ($i = 0; $i < count($lines); $i++) {
    $count += 1;
    // split the line
    list($limits, $letter, $password) = explode(" ",$lines[$i]);

    print "limits = $limits\n";
    print "letter = $letter\n";
    print "password = $password\n";

    // get the low and high limits
    list($low,$high) = explode("-", $limits);
    // get the character
    $letter = trim($letter,":");
    $character_count = substr_count($password, $letter);
    print $lines[$i] . " ";
    if ($character_count >= $low && $character_count <= $high) {
        $valid_passwords += 1;
        print "Passed\n";
    } else {
        print "Failed\n";
    }
    print "low =$low high=$high letter=$letter char=$character_count\n";
}

print "Valid passwords: " . $valid_passwords . "\n";
print "Invalid passwords: " . ($count - $valid_passwords) . "\n";
print "Count = $count\n";