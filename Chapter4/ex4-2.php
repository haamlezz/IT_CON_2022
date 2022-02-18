<?php
function summation($m, $n){
    $sum = 0;
    for($x=$m; $x<=$n; $x++){
        $sum += $x;
    }

    return $sum;
}

echo "ຜົນບວກທັງໝົດແຕ່ 1-5 = ". summation(1,5);