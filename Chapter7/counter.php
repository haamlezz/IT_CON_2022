<?php
//ob_start();

if(empty($_COOKIE['count'])){

    
    $cookie = 1;
    setcookie("count", $cookie);
    echo "ຍິນດີຕ້ອນຮັບ";
} else {
    
    $cookie = ++$_COOKIE['count'];
    setcookie("count", $cookie, time()+3600);
    echo "ເຈົ້າເຂົ້າມາຄັ້ງທີ ". $cookie;
}

?>