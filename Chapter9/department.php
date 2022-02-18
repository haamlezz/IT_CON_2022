<?php
include 'login-check.php';
include_once 'function/function.php';

$dno = $dept_name = $location = $incentive = $message = "";
if (isset($_POST['btnAdd'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));
    $incentive = str_replace("ກີບ", "", $incentive);


    //ກວດລະຫັດຊໍ້ໍາ
    $sql = "SELECT dno FROM dept WHERE dno='$dno'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == true) {
        $error_dno = "ລະຫັດນີ້ຖືກນໍາໃຊ້ແລ້ວ!";
    } else {
        $sql = "INSERT INTO dept VALUES('$dno', '$dept_name', '$location', '$incentive')";
        $result = mysqli_query($link, $sql);

        if ($result == true) {
            $dno = $dept_name = $location = $incentive = $message = "";
            $message = '<script type="text/javascript">
            Swal.fire({
                        title:"ສຳເລັດ",
                        position: "top-center",
                        icon: "success",
                        text: "ເພີ່ມຂໍ້ມູນສຳເລັດ",
                        button: "ຕົກລົງ",
                    })
        
                    </script>';
        } else {
            echo mysqli_error($link);
        }
    }
} else if (@$_GET['action'] == 'edit') {
    $dno = $_GET['dno'];
    $sql = "SELECT *FROM dept WHERE dno = '$dno'";

    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $dno = $row['dno'];
        $dept_name =  $row['name'];
        $location =  $row['loc'];
        $incentive =  $row['incentive'];
    }
} else if (isset($_POST['btnEdit'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));
    $incentive = str_replace("ກີບ", "", data_input($_POST['incentive']));


    $sql = "UPDATE dept SET name='$dept_name', loc='$location', incentive='$incentive' WHERE dno='$dno'";
    $result = mysqli_query($link, $sql);
    if ($result == true) {
        $dno = $dept_name = $location = $incentive = $message = "";
        $message = '<script type="text/javascript">
            Swal.fire({
                        title:"ສຳເລັດ",
                        position: "top-center",
                        icon: "success",
                        text: "ປັບປຸງຂໍ້ມູນສຳເລັດ",
                        button: "ຕົກລົງ",
                    })

            </script>';
    } else {
        echo mysqli_error($link);
    }
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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">

    <script defer src="js/all.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>

<body>
    <?php
    include 'menu.php';
    ?>
    <?= @$message ?>
    <div class="container mt-3 pt-3">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <fieldset class="border border-primary px-4 pb-3" style="border-radius: 8px;">
                    <legend class="float-none w-auto p-2 h5 fw-bold">ຟອມຈັດການພະແນກ</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="dno" class="form-label">ລະຫັດພະແນກ:</label>
                            <input type="text" class="form-control" id="dno" placeholder="ປ້ອນລະຫັດພະແນກ" name="dno" required value="<?= @$dno ?>" <?php if (@$_GET['action'] == 'edit') echo 'readonly' ?>>
                            <div class="form-control-feedback">
                                <div class="text-danger">
                                    <?= @$error_dno ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dept_name" class="form-label">ຊື່ພະແນກ:</label>
                            <input type="text" class="form-control" id="dept_name" placeholder="ປ້ອນຊື່ພະແນກ" name="dept_name" required value="<?= @$dept_name ?>">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">ສະຖານທີ່:</label>
                            <input type="text" class="form-control" id="location" placeholder="ປ້ອນສະຖານທີ່" name="location" required value="<?= @$location ?>">
                        </div>
                        <div class="mb-3">
                            <label for="incentive" class="form-label">ເງິນອຸດໜູນ:</label>
                            <input type="text" class="form-control" id="incentive" placeholder="ປ້ອນປັນຊເງິນອຸດໜູນ" name="incentive" required value="<?= @$incentive ?>">
                        </div>

                        <div class="text-center">
                            <?php
                            if (@$_GET['action'] == 'edit') {

                                echo '<button type="submit" name="btnEdit" class="btn btn-info" style="width: 110px; border-radius: 8px;"><i class="fas fa-plus-circle"></i>&nbsp;ແກ້ໄຂ</button>';
                            } else {
                                echo '<button type="submit" name="btnAdd" class="btn btn-primary" style="width: 110px; border-radius: 8px;"><i class="fas fa-plus-circle"></i>&nbsp;ເພີ້ມ</button>';
                            }
                            ?>

                            <button type="submit" name="reset" class="btn btn-warning" style="width: 110px; border-radius: 8px;"><i class="fas fa-sync"></i>&nbsp;ຍົກເລີກ</button>

                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-md-8 col-sm-12">
                <table id="example" class="table table-hover table-bordered" style="width:100%;">
                    <thead class="bg-secondary text-center text-white">
                        <tr>
                            <th>ລະຫັດ</th>
                            <th>ພະແນກ</th>
                            <th>ສະຖານທີ່</th>
                            <th>ເງິນອຸດໜູນ</th>
                            <th>ອ໋ອບຊັນ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT *FROM dept";
                        $result = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $row['dno'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['loc'] ?></td>
                                <td class="text-end"><?= number_format($row['incentive']) ?></td>

                                <td class="text-center" style="width: 80px;">
                                    <a href="department.php?action=edit&dno=<?= $row['dno'] ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="ແກ້ໄຂ"><i class="fas fa-edit text-success"></i></a>
                                    <a href="#" onclick="deletedata(<?php echo '\'' . $row['dno'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="right" title="ລືບຂໍ້ມູນ"><i class="fas fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/jquery.priceformat.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        /*ແຍກຈຸດຫຼັກພັນ ....*/
        $('#incentive').priceFormat({
            prefix: '',
            suffix: ' ກີບ',
            thounsandsSeparator: ',',
            centsLimit: 0
        });
    });

    //Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    //ສ້າງຟັງຊັນແຈ້ງເຕືອນລືບຂໍ້ມູນ
    function deletedata(id) {
        Swal.fire({
                title: "ເຈົ້າຕ້ອງການລືບແທ້ ຫຼື ບໍ່?",
                text: "ຂໍ້ມູນລະຫັດ " + id + ", ເມື່ອລືບຈະບໍ່ສາມາດກູ້ຂໍ້ມູນຄືນໄດ້!",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: 'ຕົກລົງ',
                denyButtonText: 'ບໍ່',
                dangerMode: true,
                buttons: ['ຍົກເລີກ', 'ຕົກລົງ']
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        url: "dept-delete.php",
                        method: "post",
                        data: {
                            dno: id
                        },
                        success: function(data) {
                            alert(data);

                            if (data) {
                                Swal.fire("ຜິດພາດ", "ລິບບໍ່ໄດ້ເພາະມີພະນັກງານສັງກັດຢູ່", "error", {
                                    button: "ຕົກລົງ",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000); //2000 = 2ວິນາທີ
                            } else {
                                Swal.fire("ສໍາເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                    button: "ຕົກລົງ",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000); //2000 = 2ວິນາທີ
                            }


                        }
                    });

                } else if (willDelete.isDenied) {
                    Swal.fire("ຂໍ້ມູນຂອງທ່ານຍັງປອດໄພ!", {
                        button: "ຕົກລົງ",
                    });
                }
            });
    }

    /* ບໍ່ໃຫ້ມັນຊັບມິດຄືນ*/
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>