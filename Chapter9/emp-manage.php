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


    //ກວດລະຫັດຊໍ້
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
    <div class="container-fluid mt-3 pt-3">

        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>ຈັດການຂໍ້ມູນພະນັກງານ</strong>
        </div>
        <p class="d-flex justify-content-end">
            <a href="emp-add.php" class=" btn btn-success text-white"><i class="fas fa-plus-circle"></i> ເພີ້ມຂໍ້ມູນ</a>
        </p>

        <table id="example" class="table table-hover table-bordered" style="width:100%;">
            <thead class="bg-secondary text-center text-white">
                <tr>
                    <th>ລະຫັດ</th>
                    <th>ຊື່ພະນັກງານ</th>
                    <th>ເພດ</th>
                    <th>ພະແນກ</th>
                    <th>ອ໋ອບຊັ້ນ</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT e.empno, e.name, e.gender, d.name AS department FROM  emp e JOIN dept d ON e.dno = d.dno";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td class="text-center"><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><?= $row[2] ?></td>
                        <td class="text-end"><?= $row[3] ?></td>

                        <td class="text-center" style="width: 80px;">
                            <a href="#" onclick="viewdata(<?php echo '\'' . $row['0'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="ລາຍລະອຽດ"><i class="fas fa-eye"></i></a>
                            &nbsp;&nbsp;
                            <a href="emp-edit.php?action=edit&empid=<?= $row[0] ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="ແກ້ໄຂ"><i class="fas fa-edit text-success"></i></a>
                            &nbsp;&nbsp;
                            <a href="#" onclick="deletedata(<?php echo '\'' . $row[0] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="right" title="ລືບຂໍ້ມູນ"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- The Modal ສະແດງລາຍລະອຽດຂໍ້ມູນ -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title h5">ລາຍລະອຽດຂໍ້ມູນພະນັກງານ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="employee_detail">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ປິດ</button>
                </div>

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


    /*ກົດທີ່ ສະແດງລາຍລະອຽດ */
    function viewdata(id) {
        $.ajax({
            url: "emp-view.php",
            method: "post",
            data: {
                empno: id
            },
            success: function(data) {
                $('#employee_detail').html(data);
                $('#myModal').modal("show");
            }
        });
    }
    /*ສິ້ນສຸດສະແດງລາຍລະອຽດ*/


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
                        url: "emp-delete.php",
                        method: "post",
                        data: {
                            emp_id:id
                        },
                        success: function(data) {
                            
                            Swal.fire("ສໍາເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                button: "ຕົກລົງ",
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000); //2000 = 2ວິນາທີ
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