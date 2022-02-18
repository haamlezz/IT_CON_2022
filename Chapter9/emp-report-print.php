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
    <style>
        table{
            border:#000000 solid thin;
            border-collapse: collapse;
        }
        tr, th{
            border: #000000 solid thin;
            height: 35px;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-3">

    <div class="text-center">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <img src="image/logo.png" alt="ໂລໂກ້" srcset="" width="100px">
        <br>
        
            <p>===========****==========</p>
    </div>

    <div class="row">
        <div class="col-sm-6 text-start">
            ຊື່ບໍລິສັດ:.............. <br>
            ທີ່ຢູ່:.............. <br>
            ເບີໂທ:.............
        </div>

        <div class="col-sm-6 text-end">
            ເລກທີ:........../........ <br>
            ທີ່  ນະຄອນຫຼວງວຽງຈັນ, ວັນທີ:............
        </div>
    </div>

    <h3 class="text-center">ລາຍງານ</h3>

        <table class="table table-bordered w-100">
            <thead class="text-center">
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


        <div class="row text-center">
            <div class="col-sm-4">ລາຍເຊັນ 1</div>
            <div class="col-sm-4">ລາຍເຊັນ 2</div>
            <div class="col-sm-4">ລາຍເຊັນ 3</div>
        </div>

    </div>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
        window.onafterprint = window.close;
        window.print();
    })
</script>