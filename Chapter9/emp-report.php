<?php
include 'login-check.php';
include_once 'function/function.php';
include_once 'laokip.php';
$dno = '';
$where = '';
if ($_GET) {
    $dno = $_GET['dno'];
    $where = empty($dno) ? " " : " WHERE d.dno = '$dno'";
}
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
        <div class="alert alert-success alert-dismissible text-center">
            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            <strong>ລາຍງານຂໍ້ມູນພະນັກງານ</strong>
        </div>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
            <div class="row">
                <div class="col-md-2 offset-md-2 text-end">
                    ເລືອກພິມລາຍງານຕາມພະແນກ
                </div>

                <div class="col-md-4">
                    <select name="dno" class="form-control" id="" onchange="form.submit()">
                        <option value="">ເລືອກພະແນກ</option>
                        <?php
                        $rs = getTable("dept");
                        while ($row = mysqli_fetch_array($rs)) {
                        ?>
                            <option <?= $dno == $row[0] ? 'selected' : '' ?> value="<?= $row[0] ?>"><?= $row[1] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>

        <p class="d-flex justify-content-end">
            <a class="btn btn-info" href="emp-report-print.php?dno=<?= $dno ?>"><i class="fas fa-print"></i> ພິມລາຍງານ</a>
            &nbsp; &nbsp;
            <a class="btn btn-danger" href="emp-report-excel.php?dno=<?= $dno ?>"><i class="fas fa-file-excel"></i> ສົ່ງອອກເປັນ Excel</a>
        </p>

        <table class="table table-hover table-bordered w-100">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>ລະຫັດ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ເພດ</th>
                    <th>ເງິນເດືອນ</th>
                    <th>ເງິນອຸດໜຸນ</th>
                    <th>ລາຍຮັບລວມ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dno = '';
                $sum = 0;
                $sql = "SELECT e.empno, e.name, e.gender, d.name AS department, s.sal, e.incentive, s.sal + e.incentive AS total FROM emp e JOIN dept d ON e.dno = d.dno JOIN salary s ON e.grade = s.grade $where ORDER BY department ASC, total DESC";

                $rs = mysqli_query($link, $sql);

                while ($row = mysqli_fetch_array($rs)) :

                    if (strcmp($dno, $row['department']) !== 0) {
                        $dno = $row['department'];
                        $sql1 = "SELECT SUM(s.sal+e.incentive) FROM emp e JOIN dept d ON e.dno=d.dno JOIN salary s ON e.grade = s.grade"
                            . " WHERE d.name = '$dno'";
                        $rs1 = mysqli_query($link, $sql1);
                        echo mysqli_error($link);
                        $row1 = mysqli_fetch_array($rs1);

                ?>
                        <tr style="background-color: #d9d9d9;">
                            <td colspan="5" class="fw-bold text-primary"><?= $dno ?>: <?= LakLao($row1[0]) ?> </td>
                            <td class="fw-bold text-primary text-end"><?= number_format($row1[0]) ?> </td>
                        </tr>
                    <?php
                    }

                    ?>
                    <tr>
                        <td class="text-center"><?= $row['empno'] ?></td>
                        <td class="text-center"><?= $row['name'] ?></td>
                        <td class="text-center"><?= $row['gender'] ?></td>
                        <td class="text-end"><?= number_format($row['sal']) ?></td>
                        <td class="text-end"><?= number_format($row['incentive']) ?></td>
                        <td class="text-end"><?= number_format($row['total']) ?></td>
                    </tr>
                <?php
                    $sum += $row['total'];
                endwhile;
                ?>
                <tr style="background-color: #d9d9d9;">
                    <td colspan="5" class="fw-bold text-danger">ລວມທັງໝົດ: <?= LakLao($sum) ?> </td>
                    <td class="fw-bold text-danger text-end"><?= number_format($sum) ?> </td>
                </tr>
            </tbody>
        </table>

    </div>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>