<?php
//static variable
function myTest(){
    static $x = 0;
    echo "$x <br>";
    $x++;
}


myTest(); //0
myTest(); //1
myTest(); //2