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
$options = getopt("n", [], $optind);
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

echo implode("", bubbleSort(checkForNextLine(file($fileName)), $funcCallback));