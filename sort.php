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

function bubbleSort($sort_array)
{
    $array_indexes = count($sort_array);
    $sorted = false;

    for ($i = 0; $i < $array_indexes; $i++) {
        for ($j = 0; $j < $array_indexes - $i - 1; $j++) {
            if ($sort_array[$j + 1] < $sort_array[$j]) {
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

if($argc > 1 && substr($argv[1], 0, 1) !== '-') {
    $fileName = $argv[1];
} else {
    $fileName = 'php://stdin';
}

echo implode("", bubbleSort(checkForNextLine(file($fileName))));