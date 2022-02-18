<?php
session_start();
include_once 'connect-db.php';

if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
    // $username = $_SESSION['username'];
    // $password = $_SESSION['password'];
    // $sql = "SELECT username, password FROM user WHERE username = '$username' AND password = '$password'";
    // $rs = mysqli_query($link, $sql);

    // if(mysqli_num_rows($rs) <= 0){
    header("location: login-form.php");
    // }
} else {
    //header("location: login-form.php");
}