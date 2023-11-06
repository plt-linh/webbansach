<?php
    session_start();
    include('db/MySQLConnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>
<body>
    <div class="container-fluid index" id = "index"></div>
    <!-- header -->
    <?php 
        require("interfaces/header.php"); 
    ?>
    
    <!-- content -->
    <div class="content">
        <?php
            include("interfaces/products.php");
        ?>
    </div>
    

    <!-- footer -->
    <?php 
        require("interfaces/footer.php");
    ?>
</body>
</html>