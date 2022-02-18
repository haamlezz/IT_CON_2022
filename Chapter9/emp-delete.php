<?php
include_once 'connect-db.php';
$emp_id = $_POST['emp_id'];

$sql = "SELECT picture FROM emp WHERE empno = '$emp_id'";
echo $sql;
$rs = mysqli_query($link, $sql);
$row = mysqli_fetch_array($rs);
$picture = $row['picture'];

unlink($picture);

$sql = "DELETE FROM emp WHERE empno = '$emp_id'";
mysqli_query($link, $sql);
echo mysqli_error($link);