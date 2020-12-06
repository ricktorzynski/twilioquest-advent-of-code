<?php

$lines = file("input2.txt", FILE_IGNORE_NEW_LINES);

$number_of_rows = count($lines);
$number_of_columns = strlen($lines[0]);

$rise = [1,1,1,1,2];
$run = [1,3,5,7,1];

$product_of_trees = 1;

for ($slopes = 0; $slopes < count($rise); $slopes++) {
    $num_steps_per_line = ceil($number_of_columns / $run[$slopes]);
    $total_rows = 2 * ceil(($number_of_rows * $num_steps_per_line * $run[$slopes]) / $number_of_columns);
    $number_of_trees = 0;
    $number_of_open = 0;

    for ($i = 0; $i < count($lines); $i++) {
        $row[$i] = str_split($lines[$i]);
        $current_row[$i] = $row[$i];
        for ($expand = 1; $expand < $total_rows; $expand++) {
            $row[$i] = array_merge($row[$i], $current_row[$i]);
        }
    }
    $count = 0;
    for ($i = 0; $i < count($lines); $i = $i + $rise[$slopes]) {
        // print "row = $i column = " . $count * $run[$slopes] . " ";
        // print "rise = " . $rise[$slopes] . "\n";


        if ($row[$i][$count * $run[$slopes]] == "#") {
            $number_of_trees += 1;
            // print "#";
        } else {
            $number_of_open += 1;
            // print ".";
        }
        $count += 1;
        // print "\n";
    }

    print "slope $slopes number of trees=$number_of_trees\n";
    print "  row = $i\n";

    $product_of_trees = $product_of_trees * $number_of_trees;
}

print "total_rows = $total_rows\n";
print "product of trees = $product_of_trees\n";
print "number of open = $number_of_open\n";

