<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'website';

    $conn = new mysqli($server, $user, $pass, $database);
    $conn -> set_charset("utf8");
    //kiểm tra kết nối 
    if($conn->connect_error){
        var_dump($connect->connect_error);
        echo "\n Kết Nối DB thất bại";
        die();
    }
    else echo "<br>";
?>
