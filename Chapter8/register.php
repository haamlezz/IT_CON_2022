<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ສະແດງຂໍ້ມູນ</title>
</head>
<body>
    <?php
        if($_POST){
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $gender     = $_POST['gender'];
            $age       = $_POST['age'];
            $email      = $_POST['email'];
            $address    = nl2br($_POST['address']);
            $sport      = implode(",", $_POST['sport']);

            echo "<table>
                <tr>
                    <td>ຊື່: </td>
                    <td>$username</td>
                </tr>
                <tr>
                    <td>ລະຫັດຜ່ານ: </td>
                    <td>$password</td>
                </tr>
                <tr>
                    <td>ເພດ: </td>
                    <td>$gender</td>
                </tr>
                <tr>
                    <td>ອາຍຸ: </td>
                    <td>$age</td>
                </tr>
                <tr>
                    <td>ອີເມວ: </td>
                    <td>$email</td>
                </tr>
                <tr>
                    <td style='vertical-align:top;'>ທີ່ຢູ່: </td>
                    <td>$address</td>
                </tr>
                <tr>
                    <td>ກິລາທີ່ມັກ: </td>
                    <td>$sport</td>
                </tr>
            </table>";
        }
    ?>
</body>
</html>