<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: auto;
        }
        table{
            width:80%;
            margin: auto;
        }
        td, th{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        $arr = array(
            "row1"=>[20, 30, 10, 10],
            "row2"=>[10, 25, 5, 40],
            "row3"=>[20, 40, 30, 30]
        );

        echo "<table>";
            echo "<tr>
                    <th></th>
                    <th>col1</th>
                    <th>col2</th>
                    <th>col3</th>
                    <th>col4</th>
                    <th>Total</th>
                </tr>";
            
            foreach($arr as $k => $v){
                echo "<tr>";
                    echo "<th>$k</th>";
                    $total = 0;
                    foreach($v as $number){
                        $total+=$number;
                        echo "<td>$number</td>";
                    }
                    echo "<td>$total</td>";
                echo "</tr>";
            }

        echo "</table>";
    ?>
</body>
</html>