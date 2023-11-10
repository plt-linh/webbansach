<?php
    include "../../db/MySQLConnect.php";

    $this_id=$_GET['this_id'];

    $sql = "DELETE FROM products WHERE PRODUCT_ID = '$this_id' ";
    mysqli_query($connect,$sql);

    header('location: ../index.php '); //quay lại trang quản lý sản phẩm
?>