<?php
include 'login-check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ລະບົບຈັດການຂໍ້ມູນສະມາຊິກກຳມະບານຂອງສະມາຄົມການສຶກສາພາກເອກະຊົນ</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/all.js"></script>
</head>
<body>
<?php
include 'menu.php';
?>

<div class="container-fluid mt-3">
    <?php
        echo "ສະບາຍດີ " . $_SESSION['username'];
    ?>
</div>
<script src="js/jquery-3.6.0.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>