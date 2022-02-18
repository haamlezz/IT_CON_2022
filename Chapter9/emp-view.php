<?php
include 'connect-db.php';
if (isset($_POST['empno'])) {
    $empno = $_POST['empno'];
    $output = '';
    $sql = "SELECT e.empno, e.name, e.gender, e.dateOfBirth, year(curdate())-year(e.dateOfBirth) AS age,"
            . " e.address, e.picture, d.name AS department, s.sal, e.incentive, s.sal+e.incentive AS total"
            . ", e.language FROM emp e JOIN dept d ON e.dno=d.dno JOIN salary s ON e.grade=s.grade"
            . " WHERE e.empno='$empno' ";

    $result = mysqli_query($link, $sql);
    echo mysqli_error($link);
    while ($row = mysqli_fetch_assoc($result)) {
        $picture = is_numeric($row['picture']) ? "avatar_img.png" : $row['picture'];
        $output .= '<p style="text-align: center">';

        $output .= '<img src="' . $picture . ' " alt="ຮູບພະນັກງານ" width="150px" height="200px"  class="img-thumbnail">';
        $output .= ' </p>';
        $output .= "<table>";
        $output .= "<tr><th>ລະຫັດພະນັກງານ: </th><td>" . $row['empno'] . "</td></tr>";
        $output .= "<tr><th>ຊື່ ແລະ ນາມສະກຸນ: </th><td>" . $row['name'] . "</td></tr>";
        $output .= "<tr><th>ເພດ: </th><td>" . $row['gender'] . "</td></tr>";
        $output .= "<tr><th>ວັນ, ເດືອນ, ປີເກີດ: </th><td>" . date('d / m / Y', strtotime($row['dateOfBirth'])) . "</td></tr>";
        $output .= "<tr><th>ອາຍຸ: </th><td>" . $row['age'] . " ປີ" . "</td></tr>";
        $output .= "<tr><th>ທີ່ຢູ່: </th><td>" . $row['address'] . "</td></tr>";
        $output .= "<tr><th>ພະແນກ: </th><td>" . $row['department'] . "</td></tr>";
        $output .= "<tr><th>ເງິນເດືອນ: </th><td>" . number_format($row['sal']) . " ກີບ</td></tr>";
        $output .= "<tr><th>ເງິນອຸດໜູນ: </th><td>" . number_format($row['incentive']) . " ກີບ</td></tr>";
        $output .= "<tr><th>ລາຍຮັບລວມ: </th><td>" . number_format($row['total']) . " ກີບ</td></tr>";
        $output .= "<tr><th>ພາສາຕ່າງປະເທດ: </th><td>" . $row['language'] . "</td></tr>";
        $output .= "</table>";
    }

    echo $output;
}