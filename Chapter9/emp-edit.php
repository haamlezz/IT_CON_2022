<?php
include 'login-check.php';
include_once 'function/function.php';

if($_GET){
$emp_id = mysqli_real_escape_string($link, $_GET['empid']);
$sql = "SELECT * FROM emp WHERE empno = $emp_id";
$rs = mysqli_query($link, $sql);
$row = mysqli_fetch_array($rs);

print_r($row);

$emp_id = $row['empno'];
$emp_name = $row['name'];
$emp_gender = $row['gender'];
$emp_dob = $row['dateOfBirth'];
$address = $row['address'];
$grade = $row['grade'];
$picture = is_numeric($row['picture']) ? "icons8-user-100.png" : $row['picture'];
$incentive = $row['incentive'];
$dno = $row['dno'];
$language = ' '.$row['language'];
}
if (isset($_POST['btnEdit'])) {

    print_r($_POST);
    print_r($_FILES);
    //exit();

    $emp_id = $emp_name = $emp_gender = $address = $grade = $incentive = $dno = $language = "";

    $emp_id = mysqli_real_escape_string($link, $_POST['emp_id']);
    $emp_name = mysqli_real_escape_string($link, $_POST['emp_name']);
    $emp_gender = mysqli_real_escape_string($link, $_POST['emp_gender']);
    $emp_dob = mysqli_real_escape_string($link, $_POST['emp_dob']);
    $address = mysqli_real_escape_string($link, $_POST['address']);

    $grade = mysqli_real_escape_string($link, $_POST['grade']);



    $incentive = mysqli_real_escape_string($link, $_POST['incentive']);
    $incentive = str_replace(",", "", $incentive);
    $incentive = str_replace("ກີບ", "", $incentive);

    $dno = mysqli_real_escape_string($link, $_POST['dno']);
    $language = $_POST['language'];
    $language = implode(',', $language);


    if (empty($_FILES["fileToUpload"]["name"])) {
        $sql = "UPDATE emp SET name = '$emp_name', gender='$emp_gender', dateOfBirth='$emp_dob', address='$address',
        incentive=$incentive, language='$language', grade=$grade, dno='$dno' WHERE empno='$emp_id'";

        echo $sql;

        if(mysqli_query($link, $sql)){
            header("location:emp-manage.php");
        }else{
            echo mysqli_error($link);
        }

    } else {
        //upload
        $image_url = '';

        $target_dir = "image/";
        $target_file = $target_dir . date('Ymj') . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["btnAdd"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $image_url = $target_file;
                $uploadOk = 1;
            } else {
                $error_grade = "ຟາຍທີ່ອັບໂຫຼດບໍ່ແມ່ນຮູບພາບ!";
                $uploadOk = 0;
            }
        }


        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $error_grade =  "ຟາຍຮູບໃຫຍ່ເກີນກຳນົດ";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error_grade =  "ກະລຸນາເລືອກຟາຍ jpg, png, jpeg, gig ເທົ່ານັ້ນ.";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            $message = '<script type="text/javascript">
                Swal.fire({
                        title:"ບໍ່ສຳເລັດ",
                        position: "top-center",
                        icon: "warning",
                        text: "'.$error_grade.'",
                        button: "ຕົກລົງ",
                    }).then((data)=>{
                        window.location.href = "emp-manage.php";
                    });
                    </script>';
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $sql = "UPDATE emp SET name = '$emp_name', gender='$emp_gender', dateOfBirth='$emp_dob', address='$address',
        incentive=$incentive, language='$language', grade=$grade, dno='$dno', picture='$target_file' WHERE empno='$emp_id'";
        echo $sql;
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
                    }).then((data)=>{
                        window.location.href = "emp-manage.php";
                    });
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
                    }).then((data)=>{
                        window.location.href = "emp-mange.php";
                    });
                    </script>';
                }
            } else {
                echo "ບໍ່ສາມາດອັບໂຫຼດໄດ້";
            }
        } //upload ok = 0



    } //num_rows != 1
} 
// else if (@$_GET['action'] == 'edit') {
//     $grade = $_GET['grade'];
//     $sql = "SELECT * FROM salary WHERE grade = '$grade'";

//     $result = mysqli_query($link, $sql);

//     while ($row = mysqli_fetch_assoc($result)) {
//         $grade = $row['grade'];
//         $sal =  $row['sal'];
//     }
// } else if (isset($_POST['btnEdit'])) {
//     $grade = data_input($_POST['grade']);
//     $sal = str_replace(",", "", data_input($_POST['sal']));
//     $sal = str_replace("ກີບ", "", $sal);

//     $sql = "UPDATE salary SET sal='$sal' WHERE grade='$grade'";
//     $result = mysqli_query($link, $sql);
//     if ($result == true) {
//         $grade = $sal = "";
//         $message = '<script type="text/javascript">
//             Swal.fire({
//                         title:"ສຳເລັດ",
//                         position: "top-center",
//                         icon: "success",
//                         text: "ປັບປຸງຂໍ້ມູນສຳເລັດ",
//                         button: "ຕົກລົງ",
//                     })

//             </script>';
//     } else {
//         echo mysqli_error($link);
//         $message = '<script type="text/javascript">
//                 Swal.fire({
//                         title:"ບໍ່ສຳເລັດ",
//                         position: "top-center",
//                         icon: "warning",
//                         text: "ບາງຢ່າງຜິດພາດ",
//                         button: "ຕົກລົງ",
//                     })
//                     </script>';
//     }
// }
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
        <div class="col-md-10 offset-md-1">
            <span class="d-flex justify-content-end mb-3">
                <a href="emp-manage.php" class="btn btn-secondary"><i class="fas fa-address-card"></i>&nbsp; ສະແດງຂໍ້ມູນ</a>
            </span>
            <div class="card border-info">
                <div class="card-header bg-info text-white h5">ປັບປຸງຂໍ້ມູນພະນັກງານ</div>
                <div class="card-body bg-light">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>

                        <div class="row">
                            <div class="col-md-8">
                                <!---->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emp_id" class="form-label">ລະຫັດພະນັກງານ</label>
                                        <div class="input-group">
                                            <input value="<?= @$emp_id ?>" type="hidden" name="emp_id">
                                            <input value="<?= @$emp_id ?>" disabled type="text" id="emp_id" class="form-control" placeholder="ປ້ອນລະຫັດພະນັກງານ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emp_name" class="form-label">ຊື່ພະນັກງານ</label>
                                        <div class="input-group">
                                            <input value="<?= @$emp_name ?>" type="text" name="emp_name" id="emp_name" class="form-control" placeholder="ປ້ອນຊື່ພະນັກງານ">
                                        </div>
                                    </div>
                                </div>

                                <!---->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">ເພດ</label>
                                        <div class="input-group">
                                            <div class="form-check form-check-inline">
                                                <input  <?= @$emp_gender=='M'? 'checked' : ''  ?> type="radio" name="emp_gender" value="M" id="male" class="form-check-input"> <label for="male" class="form-check-label">ຊາຍ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input  <?= @$emp_gender=='F'? 'checked' : '' ?> type="radio" name="emp_gender" value="F" id="female" class="form-check-input"> <label for="female" class="form-check-label">ຍິງ</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="emp_dob" class="form-label">ວັນເດືອນປີເກີດ</label>
                                        <div class="input-group">
                                            <input  value="<?= @$emp_dob ?>" type="date" name="emp_dob" id="emp_dob" class="form-control" placeholder="ປ້ອນວັນເດືອນປີເກີດ">
                                        </div>
                                    </div>
                                </div>

                                <!---->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">ທີ່ຢູ່</label>
                                        <div class="input-group">
                                            <textarea name="address" id="address" cols="30" rows="5" class="form-control"> <?= @$emp_id ?></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!---->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="grade" class="form-label">ຂັ້ນເງິນເດືອນ</label>
                                        <div class="input-group">
                                            <select class="form-select" name="grade" id="grade">
                                                <option value="0">ເລືອກຂັ້ນເງິນເດືອນ</option>
                                                <?php
                                                $rs = getTable("salary");
                                                while ($row = mysqli_fetch_array($rs)) {
                                                ?>
                                                    <option <?= $grade==$row[0]?'selected':'' ?> value="<?= $row[0] ?>"><?= number_format($row[1]) ?></option>
                                                <?php
                                                  //  echo "<option value='" . $row[0] . "'>" . number_format($row[1]) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="incentive" class="form-label">ເງິນອຸດໜຸນ</label>
                                        <div class="input-group">
                                            <input value="<?= $incentive ?>" type="text" name="incentive" id="incentive" class="form-control" placeholder="ປ້ອນເງິນອຸດໜຸນ">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!--ຮູບພາບ -->
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <label for="incentive" class="form-label">ຮູບໂປຣຟາຍ</label>
                                    <div>
                                        <img src="" alt="" id="img-upload" width="150" height="180">
                                    </div>            
                                    
                                    <div id="temp-img">
                                        <input type="hidden" name="old_picture" value="<?= $picture ?>">
                                        <img src="<?= $picture ?>" alt="" srcset="" width="150" height="180">
                                    </div>

                                    <div class="input-group">
                                        <input class="form-control" name="fileToUpload" type="file" id="formFile">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="dno" class="form-label">ພະແນກ</label>
                                    <div class="input-group">
                                        <select class="form-select" name="dno" id="dno">
                                            <option value="0">ເລືອກພະແນກ</option>
                                            <?php
                                            $rs = getTable("dept");
                                            while ($row = mysqli_fetch_array($rs)) {
                                            ?>
                                                <option <?= $dno==$row[0]?'selected' : '' ?> value="<?= $row[0] ?>"><?= $row[1] ?></option>
                                            <?php
                                                echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="">ເລືອກພາສາ</label>
                                    <div class="input-group">

                                        <div class="form-check form-check-inline">
                                            <input <?= strpos($language,'ອັງກິດ')?'checked':'' ?> class="form-check-input" name="language[]" type="checkbox" value="ອັງກິດ" id="eng">
                                            <label class="form-check-label" for="eng">
                                                ອັງກິດ
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input <?= strpos($language,'ຈີນ')?'checked':'' ?> class="form-check-input" name="language[]" type="checkbox" value="ຈີນ" id="chi">
                                            <label class="form-check-label" for="chi">
                                                ຈີນ
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input <?= strpos($language,'ຫວຽດນາມ')?'checked':'' ?> class="form-check-input" name="language[]" type="checkbox" value="ຫວຽດນາມ" id="viet">
                                            <label class="form-check-label" for="viet">
                                                ຫວຽດນາມ
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" name="btnEdit" value="ປັບປຸງຂໍ້ມູນ" class="btn btn-primary">
                            &nbsp;&nbsp;
                            <a href="emp-manage.php" class="btn btn-warning">ຍົກເລີກ</a>
                        </div>

                    </form>
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
        $('#img-upload').hide();
        $(document).on('change', '#formFile', function(){
            console.log($(this));
            $("#img-upload").attr("src", URL.createObjectURL(this.files[0]));
            $('#temp-img').hide();
            $('#img-upload').show();
            //$('#img-upload').attr('src',$(this).val());
        });

        /*ແຍກຈຸດຫຼັກພັນ ....*/
        $('#incentive').priceFormat({
            prefix: '',
            suffix: ' ກີບ',
            limit: 7,
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
                            console.log(data);
                            Swal.fire("ສໍາເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                button: "ຕົກລົງ",
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000); //2000 = 2ວິນາທີ
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