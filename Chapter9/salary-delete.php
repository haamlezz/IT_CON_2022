<?php
include 'login-check.php';

$grade = mysqli_real_escape_string($link, $_POST['grade']);

$sql = "DELETE FROM salary WHERE grade = '$grade'";

mysqli_query($link, $sql);
echo mysqli_error($link);