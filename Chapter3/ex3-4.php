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

        table, td{
            border: 2px dotted red;
        }

        td{
            width: 50px;
            height: 50px;
            text-align: center;
        }

        tr:nth-child(even){
            background-color: greenyellow;
        }

        tr:nth-child(odd){
            background-color: antiquewhite;
        }


    </style>
    
</head>
<body>
    <h3 style="text-align: center;">ສະແດງການຄູນເລກ</h3>

    <?php
        echo "<table>";
                for($x = 1; $x<=9; $x++) {
                    echo "<tr>";
                        for ($y=1; $y<=9; $y++){
                            echo "<td>", $x * $y,"</td>";
                        }
                    echo "</tr>";
                }
        echo "</table>";
    ?>
</body>
</html>