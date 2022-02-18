<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            margin-left:auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        table, td, th{
            border: 2px solid blue;
        }

        td,th{
            width: 50px;
            height: 50px;
            text-align: center;
        }

        tr:first-child td{
            background-color: orange;
        }

        td:nth-child(1){
            background-color: orange;
        }

        .empty{
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center;">ວຽກບ້ານວິຊາ PHP - LOOP</h3>
    <?php
        //ເລີ່ມຕົ້ນຕາຕະລາງ
        echo '<table>';
        
        $row = 0;//ໂຕປ່ຽນລຳດັບແຖວ
        
        $col = 1;//ໂຕປ່ຽນລຳດັບຖັນ

            //ເລີ່ມວົນຮອບ $x ແມ່ນລວງນອນ
            for($x=0; $x<=9; $x++){

                echo "<tr>";//ເລີ່ມແຖວ

                    //ກວດສອບ ຖ້າຫາກ $row ມີຄ່າເປັນ 0 ກໍຄືແຖວທຳອິດ ໃຫ້ສະແດງເປັນຫ້ອງວ່າງເປົ່າ
                    //ແຕ່ຖ້າ $row ບໍ່ແມ່ນ 0 ກໍໃຫ້ສະເລີ່ມສະແດງລຳດັບແຖວ
                    echo ($row==0) ? "<td></td>" : "<td>$row</td>";

                    //ເລີ່ມວົນຮອບ $y ແມ່ນລວງຕັ້ງ
                    for($y=1; $y<=9; $y++){

                        //ກວດສອບຄ່າ $x ຖ້າຫາກວ່າມັນມີຄ່າເທົ່າ 0 ໃຫ້ສະແດງໂຕເລກຖັນອອກມາ
                        //ໝາຍຄວາມວ່ານີ້ຄືຫົວແຖວ
                        if($x==0){
                            //ກວດສອບ ຖ້າຫາກຄ່າ $x ເປັນ 0 ໃຫ້ສະແດງຫົວແຖວອອກມາ
                            //ເຊິ່ງສະແດງເລກລຳດັບຂອງແຕ່ລະຖັນ
                            echo "<td>$col</td>"; //ສະແດງເລກຖັນ 1,2,3,4,5...9
                        }else {
                            //else ໝາຍເຖິງກໍລະນີທີ່ບໍ່ແມ່ນຫົວແຖວ ເປັນຂໍ້ມູນໃນຕາຕະລາງ

                            //ກວດສອບເງື່ອນໄຂ $x>=$y ກໍລະນີທີ່ $x ມີຄ່າໃຫຍ່ກວ່າ ຫຼື ເທົ່າກັບ $y 
                            //ແມ່ນໃຫ້ສະແດງຜົນຄູນ
                            //ບໍ່ດັ່ງນັ້ນໃຫ້ສະແດງສີເຫຼືອງອອກມາ
                            if($x>=$y) {
                                echo "<td>",$x*$y,"</td>";//ສະແດງຜົນຄູນ
                            }else{
                                echo "<td class='empty'></td>";//ສະແດງສີເຫຼືອງ
                            } //
                        } //

                        //ເພີ່ມຄ່າຖັນຂຶ້ນເທື່ອລະໜຶ່ງ
                        $col++;
                    }//ສິ້ນສຸດວົນຮອບໃນ

                    //ຄືນຄ່າຖັນໃຫ້ເປັນ 0
                    $col=0;

                    //ເພີ່ມຄ່າແຖວຂຶ້ນເທື່ອລະໜຶ່ງ
                    $row++;

                echo "</tr>";
            }//ສິ້ນສຸດວົນຮອບຖັນ
            

        echo '</table>';
    ?>
</body>
</html>