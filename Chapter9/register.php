<?php
    session_start();

    include 'connect-db.php';
    include 'function/function.php';

    $isValid = [
        'name' => '',
        'phone' => '',
        'username' => '',
        'pwd' => '',
        'con-pwd' => '',
        'register'=>''
    ];

    $data = [
        'name' => '',
        'phone' => '',
        'username' => '',
        'pwd' => '',
        'con-pwd' => '',
        'register'=>''
    ];

    $con_pwd_error_msg = 'ກະລຸນາປ້ອນລະຫັດຜ່ານຢືນຢັນ';

    if(isset($_POST['register'])){
        foreach($_POST as $k=>$v){
                if($_POST[$k] == ""){
                    $isValid[$k] = 'is-invalid';
                }
                $data[$k] = data_input($v);
        }

        if(!empty($_POST['con-pwd'])){
            if($_POST['pwd'] != $_POST['con-pwd']){
                $isValid['con-pwd'] = 'is-invalid';
                $con_pwd_error_msg = 'ລະຫັດຜ່ານບໍ່ກົງກັນ';
            }
        }

        $sql = "SELECT username, tel FROM user WHERE username = '".$data['username']."' OR tel = '".$data['phone']."'";
        $rs = mysqli_query($link, $sql);
        if(mysqli_num_rows($rs) >  0){
            $message = '<script type="text/javascript">
            Swal.fire({
                        title:"ຜິດພາດ",
                        position: "top-center",
                        icon: "error",
                        text: "ມີຜູ້ໃຊ້ບັນຊີນີ້ແລ້ວ",
                        button: "ຕົກລົງ",
                    })

            </script>';
        } else {
            $sql_insert = "INSERT INTO user(name, tel, username, password)
                            VALUES(
                                '".$data['name']."',
                                '".$data['phone']."',
                                '".$data['username']."',
                                '".md5($data['pwd'])."'
                                );";
            if(mysqli_query($link, $sql_insert)){
                $message = '<script type="text/javascript">
                Swal.fire({
                            title:"ສຳເລັດ",
                            position: "top-center",
                            icon: "success",
                            text: "ລົງທະບຽນສຳເລັດ",
                            button: "ຕົກລົງ",
                        }).then(function(){
                            window.location = "login-form.php";
                        })
        
                </script>';
                //header("location:login-form.php");
            } else {
                $message = '<script type="text/javascript">
                Swal.fire({
                            title:"ຜິດພາດ",
                            position: "top-center",
                            icon: "error",
                            text: "ບໍ່ສາມາດລົງທະບຽນໄດ້ ລອງໃໝ່ອີກຄັ້ງ",
                            button: "ຕົກລົງ",
                        })

                </script>';
            }
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

    <script defer src="js/all.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>

<body>
    <?php
    include 'menu.php';
    echo @$message;
    ?>

    <div class="container">
        <div class="container-fluid mt-3 mb-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <fieldset class="border border-primary px-4" style="border-radius: 8px;">
                        <legend class="float-none w-auto p-2 h5 fw-bold">ຟອມປ້ອນຂໍ້ມູນລົງທະບຽນ</legend>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">ຊື່ ແລະ ນາມສະກຸນ: </label>
                                <div class="input-group has-validation">
                                    <input type="name" class="form-control <?php echo $isValid['name']; ?>" id="name" placeholder="ປ້ອນຊື່ ແລະ ນາມສະກຸນ" name="name" required value="<?= @$data['name'] ?>">
                                    <div id="name" class="invalid-feedback">
                                        ກະລຸນາປ້ອນຊື່ ແລະ ນາມສະກຸນ
                                    </div>
                                </div>

                            </div>


                            <div class="mb-3">
                                <label for="phone" class="form-label">ເບີໂທ: </label>
                                <div class="input-group has-validation">
                                    <input type="tel" class="form-control <?php echo $isValid['phone']; ?>
                                        " id="phone" placeholder="ປ້ອນເບີໂທ" name="phone" required value="<?= @$data['phone'] ?>">
                                    <div id="phone" class="invalid-feedback">
                                        ກະລຸນາປ້ອນເບີໂທ
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">ບັນຊີເຂົ້າໃຊ້: </label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control <?php echo $isValid['username']; ?>" id="username" placeholder="ປ້ອນບັນຊີເຂົ້າໃຊ້" name="username" required value="<?= @$data['username'] ?>">
                                    <div id="username" class="invalid-feedback">
                                        ກະລຸນາປ້ອນບັນຊີເຂົ້າໃຊ້
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="pwd" class="form-label">ລະຫັດຜ່ານ: </label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control <?php echo $isValid['pwd']; ?>" id="pwd" placeholder="ປ້ອນລະຫັດຜ່ານ" name="pwd" required value="<?= @$data['pwd'] ?>">
                                    <div id="pwd" class="invalid-feedback">
                                        ກະລຸນາໃສ່ລະຫັດຜ່ານ
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="con-pwd" class="form-label">ຢືນຢັນລະຫັດຜ່ານ: </label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control <?php echo $isValid['con-pwd']; ?>" id="con-pwd" placeholder="ປ້ອນລະຫັດຜ່ານຢືນຢັນ" name="con-pwd" required>
                                    <div id="con-pwd" class="invalid-feedback">
                                        <?= empty($data['name']) ? 'ກະລຸນາໃສ່ລະຫັດຜ່ານ': ''; ?>
                                        <?= @$con_pwd_error_msg; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <button class="btn btn-primary" name="register" type="submit"> <i class="fas fa-user-plus"></i> ລົງທະບຽນ</button>
                                <button class="btn btn-warning" type="reset"> <i class="fas fa-ban"></i> ຍົກເລີກ</button>
                            </div>
                        </form>
                        <hr>
                        <p>
                            <span class="text-secondary">ມີບັນຊີແລ້ວ?</span> &nbsp; <a href="login-form.php">ເຂົ້າສູ່ລະບົບ</a>
                        </p>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>