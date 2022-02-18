<?php
include 'login-check.php';
include_once 'function/function.php';

$grade = $sal = "";
if (isset($_POST['btnAdd'])) {

    $grade = data_input($_POST['grade']);
    $sal = str_replace(",", "", data_input($_POST['sal']));
    $sal = str_replace("ກີບ", "", $sal);
    
    //ກວດລະຫັດຊໍ້ໍາ
    $sql = "SELECT grade FROM salary WHERE grade='$grade'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == true) {
        $error_grade = "ຂັ້ນນີ້ຖືກນຳໃຊ້ແລ້ວ!";
    } else {
        $sql = "INSERT INTO salary VALUES('$grade', '$sal')";
        $result = mysqli_query($link, $sql);
  
        if ($result == true) {
            $grade = $sal = "";
            $message = '<script type="text/javascript">
            Swal.fire({
                        title:"ສຳເລັດ",
                        position: "top-center",
                        icon: "success",
                        text: "ເພີ່ມຂໍ້ມູນສຳເລັດ",
                        button: "ຕົກລົງ",
                    }).then(){

                    }
                    </script>';
        } else {
            echo $mysqli_error($link);
            $message = '<script type="text/javascript">
                Swal.fire({
                        title:"ບໍ່ສຳເລັດ",
                        position: "top-center",
                        icon: "warning",
                        text: "ບາງຢ່າງຜິດພາດ",
                        button: "ຕົກລົງ",
                    })
                    </script>';
        }
    }
} else if (@$_GET['action'] == 'edit') {
    $grade = $_GET['grade'];
    $sql = "SELECT * FROM salary WHERE grade = '$grade'";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $grade = $row['grade'];
        $sal =  $row['sal'];
    }
} else if (isset($_POST['btnEdit'])) {
    $grade = data_input($_POST['grade']);
    $sal = str_replace(",", "", data_input($_POST['sal']));
    $sal = str_replace("ກີບ", "", $sal );

    $sql = "UPDATE salary SET sal='$sal' WHERE grade='$grade'";
    $result = mysqli_query($link, $sql);
    if ($result == true) {
        $grade = $sal = "";
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
        $message = '<script type="text/javascript">
                Swal.fire({
                        title:"ບໍ່ສຳເລັດ",
                        position: "top-center",
                        icon: "warning",
                        text: "ບາງຢ່າງຜິດພາດ",
                        button: "ຕົກລົງ",
                    })
                    </script>';
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
            <legend class="float-none w-auto p-2 h5 fw-bold">ຟອມຈັດການເງິນເດືອນ</legend>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="grade" class="form-label">ຂັ້ນເງິນເດືອນ:</label>
                            <input type="text" class="form-control" id="grade" placeholder="ປ້ອນຂັ້ນເງິນເດືອນ" name="grade" required value="<?= @$grade ?>" <?php if (@$_GET['action'] == 'edit') echo 'readonly' ?>>
                            <div class="form-control-feedback">
                                <div class="text-danger">
                                    <?= @$error_grade ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sal" class="form-label">ເງິນເດືອນ:</label>
                            <input type="text" class="form-control" id="sal" placeholder="ປ້ອນເງິນເດືອນ" name="sal" required value="<?= @$sal ?>">
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
                            <th>ຂັ້ນເງິນເດືອນ</th>
                            <th>ເງິນເດືອນ</th>
                            <th>ອ໋ອບຊັນ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM salary";
                        $result = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $row['grade'] ?></td>
                                <td class="text-end"><?= number_format($row['sal']) ?> ກີບ</td>

                                <td class="text-center" style="width: 80px;">
                                    <a href="salary.php?action=edit&grade=<?= $row['grade'] ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="ແກ້ໄຂ"><i class="fas fa-edit text-success"></i></a>
                                    <a href="#" onclick="deletedata(<?php echo '\'' . $row['grade'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="right" title="ລືບຂໍ້ມູນ"><i class="fas fa-trash-alt text-danger"></i></a>
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
        $('#sal').priceFormat({
            prefix:'',
            suffix: ' ກີບ',
            limit:7,
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
    function deletedata(grade) {
        Swal.fire({
                title: "ເຈົ້າຕ້ອງການລືບແທ້ ຫຼື ບໍ່?",
                text: "ຂໍ້ມູນລະຫັດ " + grade + ", ເມື່ອລືບຈະບໍ່ສາມາດກູ້ຂໍ້ມູນຄືນໄດ້!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ['ຍົກເລີກ', 'ຕົກລົງ']
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "salary-delete.php",
                        method: "post",
                        data: {
                            grade: grade
                        },
                        success: function(data) {

                            if(data){

                                Swal.fire("ສໍາເລັດ", "ບໍ່ສາມາດລຶບໄດ້ເນື່ອງຈາກມີຄົນໃຊ້ງານຢູ່", "error", {
                                button: "ຕົກລົງ",
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000); //2000 = 2ວິນາທີ
                            }else{
                                
                            Swal.fire("ສໍາເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                button: "ຕົກລົງ",
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000); //2000 = 2ວິນາທີ
                            }
                            
                        }
                    });

                } else {
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