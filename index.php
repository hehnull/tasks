<?php

$myarray=[];

function array_map_user($numbers, $innerFunction){
    $newarray =[];
    foreach ($numbers as $number){
        if($innerFunction($number))
        {
            $newarray[] = $number;
        }
    }
    return $newarray;
}

$innerFunction = function($n){
    return $n;
};