<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'website';

    $connect = new mysqli($server, $user, $pass, $database);
    $connect -> set_charset("utf8");
    //kiểm tra kết nối 
    if($connect->connect_error){
        var_dump($connect->connect_error);
        echo "\n Kết Nối DB thất bại";
        die();
    }
    else echo "";
?>
