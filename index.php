<?php

$originalArray=[1,2,3,4,5];

function array_map_user($numbers, $innerFunction){
    $newArray=[];
    foreach ($numbers as $number){
        $newArray[]=$innerFunction($number);
    }
    return $newArray;
}

$innerFunction = function($n){
    return $n*$n;
};
print_r(array_map_user($originalArray,$innerFunction));
