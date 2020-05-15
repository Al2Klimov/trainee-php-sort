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

function quickSort($arr, $funcCallback)
{
    $arrSize = sizeof($arr);

    if ($arrSize < 2) {
        return $arr;
    }

    $leftArray = $rightArray = array();
    $middle = $arr[0];

    for ($i = 1; $i < $arrSize; $i++) {
        if ($funcCallback($arr[$i], $middle)) {
            $leftArray[] = $arr[$i];
        } else {
            $rightArray[] = $arr[$i];
        }
    }

    $leftArray = quickSort($leftArray, $funcCallback);
    $rightArray = quickSort($rightArray, $funcCallback);

    return array_merge($leftArray, array($middle), $rightArray);
}

function mergeSort($arr, $funcCallback)
{
    if (sizeof($arr) <= 1) {
        return $arr;
    }

    $mergedArray = array();

    $middle = round(sizeof($arr) / 2, 0, PHP_ROUND_HALF_DOWN);
    $leftSide = mergeSort(array_slice($arr, 0, $middle), $funcCallback);
    $rightSide = mergeSort(array_slice($arr, $middle, sizeof($arr)), $funcCallback);

    while (0 < sizeof($leftSide) && 0 < sizeof($rightSide)) {
        if ($funcCallback($leftSide[0], $rightSide[0])) {
            $mergedArray[] = array_shift($leftSide);
        } else {
            $mergedArray[] = array_shift($rightSide);
        }
    }

    return array_merge($mergedArray, $leftSide, $rightSide);
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
$options = getopt("no:ubfRr", ["qsort", "mergesort"], $optind);
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
if (key_exists("f", $options)) {
    $makeUnique = array_map("strtoupper", $makeUnique);
}

if (key_exists("u", $options)) {
    $makeUnique = array_values(array_unique($makeUnique));
}

if (key_exists("R", $options)) {
    shuffle($makeUnique);
    $bubbleSort = $makeUnique;
} elseif (key_exists("qsort", $options)) {
    $bubbleSort = quickSort($makeUnique, $funcCallback);
} elseif (key_exists("mergesort", $options)) {
    $bubbleSort = mergeSort($makeUnique, $funcCallback);
} else {
    $bubbleSort = bubbleSort($makeUnique, $funcCallback);
}

if (key_exists("r", $options)) {
    $bubbleSort = array_reverse($bubbleSort);
}

if (key_exists("o", $options)) {
    file_put_contents($options['o'], $bubbleSort);
} else {
    echo implode("", $bubbleSort);
}