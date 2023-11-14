<?php
    session_start();
    include('db/MySQLConnect.php');

    if(!isset($_SESSION['customer_name'])) {
        header('loaction:interfaces/login.php');
    }
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
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
            background-color: #a0a0a0;
        }
    </style>

</head>
<body>
    <div class="container-fluid index" id = "index">
         <!-- header -->
        <?php require("interfaces/header.php"); ?>
        
        <!-- test -->
    
        <!-- content -->
        <div class="content">
            <?php
                require("interfaces/all_products.php");
                // if($_GET['manage'] == 'user') {
                //     require("intefaces/user.php");
                // }
                // elseif($_GET['manage'] == 'product') {
                //     require("intefaces/");
                // }
            ?>


        <!-- footer -->
        <?php 
            require("interfaces/footer.php");
        ?>
    </div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/slide.js"></script>
<script src="main.js"></script>   

</body>
</html>