<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            border: 3px solid black;
        }

        td{
            border-right: 3px solid black;
            padding-right: 20px;
            padding-left: 20px;
        }

        td:nth-child(odd){
            background-color: #2fd2ec;
        }

        td:nth-child(even){
            background-color: #ffc61a;
        }
    </style>
</head>
<body>
    <?php
        function multiple($m, $n){
            echo "<table>";
                for($x = 1; $x <= 10; $x++){
                    echo "<tr>";
                        for($k = $m; $k <= $n; $k++){
                            echo "<td>$k * $x = " . $x * $k ."</td>";
                        }
                    echo "</tr>";
                }
            echo "</table>";
        }


    multiple(2, 3);

    echo "<br>";

    multiple(2, 9);
    ?>

</body>
</html>