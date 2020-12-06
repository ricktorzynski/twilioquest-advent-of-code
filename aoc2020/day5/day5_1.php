<?php

$seats = file("input.txt", FILE_IGNORE_NEW_LINES);

function binary_split ($section,$low,$high) {
    $new_limits = [];
    $middle = $low + ((($high+1)-$low)/2)-1;
    if ($section == "F" || $section == "L") {
        $new_limits[0] = $low;
        $new_limits[1] = $middle;
    } elseif ($section == "B" || $section == "R") {
        $new_limits[0] = $middle+1;
        $new_limits[1] = $high;
    }
    return $new_limits;
}

$highest_seat_id = 0;
$seat = [];
for ($i = 0; $i < count($seats); $i++) {
    // determine row
    $low = 0;
    $high = 127;
    print $seats[$i] . "\n";
    for ($pos=0; $pos < 7; $pos++) {
       list($low,$high) = binary_split(substr($seats[$i],$pos,1),$low,$high);
       // print "low = $low high = $high\n";
    }
    $row = $low;

    // determine seat
    $low = 0;
    $high = 7;
    for ($pos=7; $pos < 10; $pos++) {
        list($low,$high) = binary_split(substr($seats[$i],$pos,1),$low,$high);
        // print "low = $low high = $high\n";
    }
    $column = $low;

    // calculate seat id row*8+seat
    $seat_id = $row * 8 + $column;
    $seat[$row][$column] = $seat_id;
    print "row $row seat $column ID = $seat_id\n";

    // is this the highest seat id?
    if ($seat_id > $highest_seat_id) {
        $highest_seat_id = $seat_id;
        print "new high ID: $highest_seat_id\n";
    }

}
print "Highest seat ID: $highest_seat_id\n";



