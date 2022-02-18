<?php
include 'login-check.php';

$dno = mysqli_real_escape_string($link, $_POST['dno']);

$sql = "DELETE FROM dept WHERE dno = '$dno'";

mysqli_query($link, $sql);
echo mysqli_error($link);
