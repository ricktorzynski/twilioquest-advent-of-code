<?php

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);

const RISE = 1;
const RUN = 3;

$number_of_trees = 0;
$number_of_open = 0;

$number_of_rows = count($lines);
$number_of_columns = strlen($lines[0]);

$rise = [1,1,1,1,2];
$run = [1,3,5,7,1];

$num_steps_per_line = ceil($number_of_columns/RUN);
$total_rows = ceil(($number_of_rows*$num_steps_per_line)/$number_of_columns);

for ($i = 0; $i < count($lines); $i++) {
    $row[$i] = str_split($lines[$i]);
    $current_row[$i] = $row[$i];
    for ($expand = 1; $expand < $total_rows; $expand++) {
        $row[$i] = array_merge($row[$i], $current_row[$i]);
    }
}

for ($i = 0; $i < count($lines); $i = $i + RISE) {
    print "row = $i ";
        if ($row[$i][$i * RUN] == "#") {
            $number_of_trees += 1;
            print "#";
        } else {
            $number_of_open += 1;
            print ".";
        }

    print "\n";
}

print "total_rows = $total_rows\n";
print "number of trees = $number_of_trees\n";
print "number of open = $number_of_open\n";

