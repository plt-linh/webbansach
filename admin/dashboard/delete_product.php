<?php
    include "../../db/MySQLConnect.php";

    $id=$_GET['id'];

    $sql = "DELETE FROM products WHERE PRODUCT_ID = '$id' ";
    mysqli_query($connect,$sql);

    header('location: ../index.php '); //quay lại trang quản lý sản phẩm
?>