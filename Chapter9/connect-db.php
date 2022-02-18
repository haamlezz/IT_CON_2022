<?php
$host       = 'localhost';
$user       = 'root';
$password   = '';
$database   = 'IT_CON_1';
$link       = mysqli_connect($host, $user, $password, $database) or die("ບໍ່ສາມາດເຊື່ອມຕໍ່ຖານຂໍ້ມູນໄດ້");

mysqli_set_charset($link, "utf8");

