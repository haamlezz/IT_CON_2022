<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ສະແດງຜົນການສອບເສັງ</h1>
    <?php
        $score = 100;

        if($score <= 70){
            echo "ເຈົ້າຜ່ານການສອບເສັງ<br/>>";
            echo "ຂໍສະແດງຄວາມຍິນດີ<br/>";
        } else {
            echo "ເຈົ້າບໍ່ຜ່ານການສອບເສັງ<br/>";
            echo "ພະຍາຍາມໃໝ່ອີກຄັ້ງ<br/>";
        }   
    ?>
</body>
</html>