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

    // check position for letter
    $letter_found = 0;

    $letter_at_position = substr($password, $low-1, 1);
    print "pos=$low letter=$letter char_at_pos=$letter_at_position\n";
    if ($letter_at_position == $letter) {
        $letter_found += 1;
    }
    $letter_at_position = substr($password, $high-1, 1);
    print "pos=$high letter=$letter char_at_pos=$letter_at_position\n";
    if ($letter_at_position == $letter) {
        $letter_found += 1;
    }

    print $lines[$i] . " ";
    if ($letter_found == 1) {
        $valid_passwords += 1;
        print "Passed\n";
    } else {
        print "Failed\n";
    }

}

print "Valid passwords: " . $valid_passwords . "\n";
print "Invalid passwords: " . ($count - $valid_passwords) . "\n";
print "Count = $count\n";