<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="../images/icon_logo.png" type="image/x-icon">
    <style>
        fieldset{
            margin-left: auto;
            margin-right: auto;
            width: 35%;
            background-color: beige;
        }
        .col1 {
            width: 106px;
        }
        .col2 {
            width: 299px;
        }
        .input-field{width: 100%;}
    </style>
</head>
<body>
    <fieldset>
        <legend><h3>ແບບຟອມລົງທະບຽນ</h3></legend>
        <form action="register.php" method="post">
            <table>
                <tr>
                    <td class="col1">ຊື່ຜູ້ໃຊ້</td>
                    <td class="col2"><input class="input-field" type="text" name="username" id="" size="40" maxlength="40"></td>
                </tr>
                <tr>
                    <td class="col1">ລະຫັດຜ່ານ</td>
                    <td class="col2"><input class="input-field" type="password" name="password" id="" size="40" maxlength="10"></td>
                </tr>
                <tr>
                    <td class="col1">ເພດ</td>
                    <td class="col2">
                        <input type="radio" name="gender" value="ຊາຍ"> ຊາຍ
                        <input type="radio" name="gender" value="ຍິງ"> ຍິງ
                    </td>
                </tr>
                <tr>
                    <td class="col1">ອາຍຸ</td>
                    <td>
                        <select name="age" id="">
                            <option value="5-10" selected="selected">5-10 ປີ</option>
                            <option value="11-15" selected="selected">11-15 ປີ</option>
                            <option value="16-20" selected="selected">16-20 ປີ</option>
                            <option value="25-30" selected="selected">25-30 ປີ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="col1">ອີເມວ</td>
                    <td class="col2">
                        <input class="input-field" type="email" name="email" id="" size="40">
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="col1">ທີ່ຢູ່</td>
                    <td class="col2">
                        <textarea class="input-field" name="address" id="" cols="36" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="col1">ກິລາທີ່ມັກ</td>
                    <td class="col2">
                        <input type="checkbox" name="sport[]" value="ບານເຕະ"> ບານເຕະ<br>
                        <input type="checkbox" name="sport[]" value="ບານສົ່ງ"> ບານສົ່ງ<br>
                        <input type="checkbox" name="sport[]" value="ລອຍນໍ້າ"> ລອຍນໍ້າ<br>
                    </td>
                </tr>
                <td> </td>
                <td>
                    <input type="submit" name="submit" value="ຕົກລົງ">
                    <input type="reset" value="ຍົກເລີກ">
                </td>
            </table>
        </form>
    </fieldset>
</body>
</html>