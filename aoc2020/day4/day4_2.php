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
$ecl = ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"];
$number_of_valid_passports = 0;
$valid_passports = [];
for ($p = 0; $p < count($passport); $p++) {
    // print $passport[$p] . "\n";
    $score = 0;
    $passport_fields = explode(" ",$passport[$p]);
    foreach ($passport_fields as $field) {
        list($name,$value) = explode(":",$field);
        $passport_field[$p][$name] = $value;
        // print "  $name = $value\n";
    }
    foreach ($required_fields as $required_field) {
        if (isset($passport_field[$p][$required_field])) {
            $score += 1;
        }
    }
    if ($score >= 7) {

        $score = 0;

        if (preg_match("#\d{4}#", $passport_field[$p]["byr"]) && intval($passport_field[$p]["byr"]) >= 1920
            && intval($passport_field[$p]["byr"]) <= 2002) {
            //print "  byr VALID\n";
            $score += 1;
        }
        if (preg_match("#\d{4}#", $passport_field[$p]["iyr"]) && intval($passport_field[$p]["iyr"]) >= 2010
            && intval($passport_field[$p]["iyr"]) <= 2020) {
            //print "  iyr VALID\n";
            $score += 1;
        }
        if (preg_match("#\d{4}#", $passport_field[$p]["eyr"]) && intval($passport_field[$p]["eyr"]) >= 2020
            && intval($passport_field[$p]["eyr"]) <= 2030) {
            //print "  eyr VALID\n";
            $score += 1;
        }
        $pattern = "/(\d{2,3})([a-z]{2})/";
        if (preg_match($pattern, $passport_field[$p]["hgt"], $match)) {
            //print "  match 1 = $match[1] match 2 = $match[2]\n";
            if ($match[2] == "in" && intval($match[1]) >= 59 && intval($match[1]) <= 76) {
                $score += 1;
                //print "  hgt VALID\n";
            } elseif ($match[2] == "cm" && intval($match[1]) >=  150 && intval($match[1]) <= 193) {
                $score += 1;
                //print "  hgt VALID\n";
            } else {
                //print "  hgt NOT VALID!\n";
            }
        } else {
            //print "  hgt NOT VALID!\n";
        }

        $hcl_pattern = "/#[0-9a-f]{6}/";

        if (preg_match($hcl_pattern, $passport_field[$p]["hcl"]) ) {
            $score += 1;

            //print "  hcl " . $passport_field[$p]["hcl"] . " VALID\n";
        } else {
            //print "  hcl " . $passport_field[$p]["hcl"] . " NOT VALID\n";
        }

        $ecl_pattern = "/([a-z]{3})/";
        if (preg_match($ecl_pattern, $passport_field[$p]["ecl"], $match)) {
            if (in_array($match[0],$ecl)) {
                $score += 1;
                //print "  ecl " . $passport_field[$p]["ecl"] . " VALID\n";
            } else {
                //print "  ecl " . $passport_field[$p]["ecl"] . " NOT VALID\n";
            }
        }

        $pid_pattern = "/\d{9}/";
        if (preg_match($pid_pattern, $passport_field[$p]["pid"],$match)) {
            $score += 1;
            // print "  pid " . $passport_field[$p]["pid"] . "  VALID $match[0]\n";
        } else {
            // print "  pid " . $passport_field[$p]["pid"] . "  NOT VALID \n";
        }

        if ($score == 7) {
            $valid_passports[] = $p;
            $number_of_valid_passports += 1;
        }



    }
}

foreach ($valid_passports as $passport_number) {
    foreach ($passport_field[$passport_number] as $key => $value) {

        //list($name,$value) = explode(":",$field);
        //$passport_field[$p][$name] = $value;
          print "  $key = $value\n";
    }
    print "\n";
}
print "Number of valid passports: $number_of_valid_passports\n";



