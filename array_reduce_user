<?php

$originalArray = [1,2,3,4,5];

function array_reduce_user($numbers, $operator){
    $result = $operator($numbers[0], $numbers[1]);
    for ($i = 2; $i < count($numbers); $i++){
        $result = $operator($result, $numbers[$i]);
    }
    return $result;
}
/*function add($a, $b){
    return $a + $b;
}
function mult($a, $b){
    return $a * $b;
}*/

print_r(array_reduce_user($originalArray, fn ($a, $b) => $a + $b));
echo "  ";
print_r(array_reduce_user($originalArray,fn ($a, $b) => $a * $b));
