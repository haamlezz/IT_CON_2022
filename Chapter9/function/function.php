<?php
function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  

function getTable ($table_name){
  global $link;
  $sql = "SELECT * FROM $table_name";
  $rs = mysqli_query($link, $sql);
  return $rs;
}