<?php
$connect = mysqli_connect("localhost","root","","test");
//con = connect = ເຊື່ອມຕໍ່

$sql = "SELECT * FROM users";

$rs = mysqli_query($connect, $sql);
echo "<table border='2'";
echo "<th>User</th>";
while($row = mysqli_fetch_array($rs)){
    echo "<tr>";
    echo "<td>".$row['username']."</td>";
    echo "</tr>";
}
echo "</table>";
