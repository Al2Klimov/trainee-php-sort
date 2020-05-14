<?php

function checkForNextLine($arr)
{
    $length = sizeof($arr);

    for ($i = 0; $i < $length; $i++) {
        if (strpos($arr[$i], "\n") === false) {
            $arr[$i] .= "\n";
        }
    }

    return $arr;
}

function castToInt($firstNum, $secondNum)
{
    return (int)$firstNum < (int)$secondNum;
}

function checkForEquality($firstNum, $secondNum)
{
    return $firstNum < $secondNum;
}

function bubbleSort($sort_array, $checkEquality)
{
    $array_indexes = count($sort_array);
    $sorted = false;

    for ($i = 0; $i < $array_indexes; $i++) {
        for ($j = 0; $j < $array_indexes - $i - 1; $j++) {
            if ($checkEquality($sort_array[$j + 1], $sort_array[$j])) {
                $tmp = $sort_array[$j + 1];
                $sort_array[$j + 1] = $sort_array[$j];
                $sort_array[$j] = $tmp;

                $sorted = true;
            }
        }

        if (! $sorted) {
            break;
        }
    }

    return $sort_array;
}

$optind = null;
$options = getopt("no:ub", [], $optind);
if (key_exists("n", $options)) {
    $funcCallback = 'castToInt';
} else {
    $funcCallback = 'checkForEquality';
}

if(isset($argv[$optind])) {
    $fileName = $argv[$optind];
} else {
    $fileName = 'php://stdin';
}

$makeUnique = checkForNextLine(file($fileName));
if (key_exists("b", $options)) {
    $makeUnique = array_map("ltrim", $makeUnique);
}

if (key_exists("u", $options)) {
    $makeUnique = array_values(array_unique($makeUnique));
}

$bubbleSort = bubbleSort($makeUnique, $funcCallback);
if (key_exists("o", $options)) {
    file_put_contents($options['o'], $bubbleSort);
} else {
    echo implode("", $bubbleSort);
}