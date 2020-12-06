<?php
$fn = fopen("input.txt","r");
$number_passport = 0;
$passport = [];

while(! feof($fn))  {
    $line = fgets($fn);
    if ($line != PHP_EOL) {
        if (!isset($passport[$number_passport])) {
            $passport[$number_passport] = rtrim($line);
        } else {
            $passport[$number_passport] .= " " . rtrim($line);
        }
    } else {
        $number_passport += 1;
    }
}
fclose($fn);

$required_fields = ["byr","iyr","eyr","hgt","hcl","ecl","pid"];
$number_of_valid_passports = 0;
for ($p = 0; $p < count($passport); $p++) {
    print $passport[$p] . "\n";
    $score = 0;
    $passport_fields = explode(" ",$passport[$p]);
    foreach ($passport_fields as $field) {
        list($name,$value) = explode(":",$field);
        $passport_field[$p][$name] = $value;
        print "  $name = $value\n";
    }
    foreach ($required_fields as $required_field) {
        if (isset($passport_field[$p][$required_field])) {
            $score += 1;
        }
    }
    if ($score >= 7) {
        $number_of_valid_passports += 1;
        print "  VALID!\n";
    }
}
print "Number of valid passports: $number_of_valid_passports\n";
