<!-- 2. ການຮັບຄ່າຈາກຟອມ -->

<?php
    if(isset($_POST['btnCal'])){
    
        if(empty($_POST['customer'])){
            $error_cus = "<span style='color:red;'>ກະລຸນາປ້ອນຊື່</span>";
        } else {
            $customer = $_POST['customer'];
        }

        if(empty($_POST['price'])){
            $error_price = "<span style='color:red;'>ກະລຸນາປ້ອນລາຄາສິນຄ້າທັງໝົດ</span>";
        } else {
            $price = $_POST['price'];
        }
    }
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
    <!-- ສ້າງຟອມ -->
    <form action="" method="post">
        
        <label for="">ຊື່ລູກຄ້າ</label> 
        <input type="text" name="customer" value="<?= @$customer ?>" placeholder="ປ້ອນຊື່ລູກຄ້າ"> <?= @$error_cus ?>
        <br>
        
        <label for="">ລາຄາສິນຄ້າທັງໝົດ</label>
        <input type="text" name="price" value="<?= @$price ?>" placeholder="ປ້ອນລາຄາສິນຄ້າ"> <?= @$error_price ?>
        <br>

        <input type="submit" name="btnCal" value="ຄຳນວນ">
        <button onclick="window.location.reload(true)">ໂຫຼດຄືນໃໝ່</button>

    </form>


    <!-- ຄຳນວນພ້ອມສະແດງຄ່າກ້ອງຟອມ -->
    <?php
        if(isset($_POST['btnCal']) && empty($error_cus) && empty($error_price)){
            if($price <= 100000) {
                $percent = 2;
            } else if($price <= 200000) {
                $percent = 3;
            } else if($price <= 500000)  {
                $percent = 5;
            } else {
                $percent = 7;
            }

            $discount = $price * $percent / 100;

            $pay = $price -$discount;

            echo "ຊື່ລູກຄ້າ : $customer <br>" ;
            echo "ລາຄາສິນຄ້າທັງໝົດ: " . number_format($price) . " ກີບ<br>";
            echo "ສ່ວນຫຼຸດ $percent% : ". number_format($discount). " ກີບ<br>";
            echo "ລາຄາສຸດທິ: ". number_format($pay). " ກີບ<br>";

        }
    ?>
</body>
</html>