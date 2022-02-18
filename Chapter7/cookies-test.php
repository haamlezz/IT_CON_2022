<?php
if(isset($_COOKIE['username'])){
    echo "Cookies value: ". $_COOKIE['username'];
}else{
    echo "ບໍ່ພົບ Cookies";
}