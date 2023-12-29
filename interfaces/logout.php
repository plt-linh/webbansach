<?php
    session_start();

    // if(isset($_SESSION['customer_name'])) {
    //     unset($_SESSION['customer_name']);
    // }
    // header("location:../index.php");
    session_destroy();
    header("location:../index.php");
?>