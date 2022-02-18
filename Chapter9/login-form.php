<?php
session_start();
include_once 'connect-db.php';
include 'function/function.php';

$isValid = [
    'username' => '',
    'password' => '',
];

if(isset($_POST['btnLogin'])){
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    if($username =='') $isValid['username'] = 'is-invalid';
    if($password == '') $isValid['password'] = 'is-invalid';

    $sql = "SELECT username,password FROM user WHERE username='$username' AND password='".md5($password)."'";
    $rs = mysqli_query($link, $sql);
    if(mysqli_num_rows($rs) == 0){
        $message = '<script type="text/javascript">
        Swal.fire({
                    title:"ຜິດພາດ",
                    position: "top-center",
                    icon: "error",
                    text: "ບັນຊີ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ",
                    button: "ຕົກລົງ",
                })
        </script>';
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        header("location:index.php");
        
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
    <script defer src="js/all.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>
<body>

<?php
include 'menu.php';
echo @$message;
?>

<div class="container-fluid mt-5">
    <div class="col-md-6 mx-auto">
        <div class="card border-info">
            <div class="card-header bg-info text-white h5">ເຂົ້າໃຊ້ລະບົບ</div>
            <div class="card-body bg-light">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>
            <label for="username" class="form-label">ບັນຊີເຂົ້າໃຊ້</label>    
            <div class="form-group mb-3 mt-3">
            <div class="input-group has-validation">
                    
                    <input type="text" name="username" class="form-control <?= $isValid['username'];?>" id="username" placeholder="ປ້ອນບັນຊີເຂົ້າໃຊ້" required value="<?= @$username?>">
                    <div id="name" class="invalid-feedback">
                                        ກະລຸນາປ້ອນບັນຊີເຂົ້າໃຊ້
                                    </div>
                </div>
            </div>
            
            <div class="form-group mb-3 mt-3">
            <label for="password" class="form-label">ລະຫັດຜ່ານ</label>
                <div class="input-group has-validation">
                    
                    <input type="password" name="password" class="form-control <?= $isValid['password'];?>" id="password" placeholder="ປ້ອນລະຫັດຜ່ານ" required value="<?= @$password?>">
                    <div id="name" class="invalid-feedback">
                                        ກະລຸນາປ້ອນລະຫັດຜ່ານ
                                    </div>
                </div>
            </div>
                

                <button type="submit" name="btnLogin" class="btn btn-primary btn-block">ເຂົ້າສູ່ລະບົບ</button>
            </form>
            <hr>
            <span class="text-secondary">ຍັງບໍ່ທັນມີບັນຊີ?</span> &nbsp; <a href="register.php">ລົງທະບຽນ</a>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.6.0.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>