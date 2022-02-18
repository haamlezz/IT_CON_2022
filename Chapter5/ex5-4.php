<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width: 60%;
            margin-left:auto ;
            margin-right: auto;
        }

        table,
        td,
        th{
            border-collapse: collapse;
            border: 1px solid black;
        }

        th{
            background-color: goldenrod;
        }
    </style>
</head>
<body>
    <?php
        $animals = array(
            "cat" => array("name"=>"ລູລີ", "legs"=>4, "seed"=>"ປາ"),
            "duck" => array("name"=>"ແພັດດີ", "legs"=>2, "seed"=>"ຫອຍ"),
            "cat" => array("name"=>"ຊູໂມ", "legs"=>4, "seed"=>"ເຂົ້າ"),
        );

        echo "<table>";
            echo "<tr>";
                echo "
                        <th>ລະຫັດ</th>
                        <th>ຊື່</th>
                        <th>ຈຳນວນຂາ</th>
                        <th>ກິນອາຫານ</th>
                    ";
            echo "</tr>";

            foreach($animals as $key => $value){
                echo "<tr>";
                    echo "<th style='background-color:yellow;'>$key</th>";

                    foreach($value as $key => $item){
                        if($k == "legs") {
                            echo "<td style='text-align:center;'>$item</td>";
                        } else {
                            echo "<td>$item</td>";
                        }
                    }
                echo "</tr>";   
            }
        echo "</table>";
    ?>
</body>
</html>