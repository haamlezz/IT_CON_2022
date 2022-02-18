<?php
$cookie_name = "username";
$cookie_value = "John";

setcookie($cookie_name, $cookie_value, time()+(86400 * 30));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        

        echo "Cookie ໄດ້ຖືກສ້າງແລ້ວ <br>";

        echo "ກົດ <a href='cookies-test.php'>Click</a> ກວດສອບຄ່າ Cookie";
    ?>
</body>
</html>