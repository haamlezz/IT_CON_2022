<?php
//Global variable
$x = 5;

//Local variable
function myTest(){

    $y = 10; //This is local variable
    echo "<p>$y</p>";

    //In case we need to use $x 
    global $x;
    echo "<p>$x</p>";

}

//call function
myTest();
