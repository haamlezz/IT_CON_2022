<?php
$x = 1;
$sum = 0;
$oper = "+";

while($x <= 5) {
    echo "$x $oper ";
    
    if($x == 4){
        $oper = " ";
    }

    $sum += $x;
    $x++;
}

echo "= $sum";