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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
        html {
            scroll-behavior: smooth;
            background-color: #a0a0a0;
        }
    </style>

</head>
<body>
        <?php
            //kiểm tra đã đăng nhập chưa
            if (isset($_SESSION['login']) && isset($_SESSION['last_activity'])) {
                // Kiểm tra xem đã hết thời gian không hoạt động chưa
                $inactiveTime = time() - $_SESSION['last_activity'];
                
                // Nếu đã hết 30 phút, đăng xuất
                if ($inactiveTime >= 1200) {
                    echo '<script>alert("Phiên đăng nhập hết hạn");</script>';
                    session_destroy();
                    echo '<script>window.history.back();</script>';
                    exit();
                }
            }
            //nếu có hoạt động thì update lại thời gian
            $_SESSION['last_activity'] = time();
        ?>
    
    <div class="container-fluid index" id = "index">
         <!-- header -->
        <?php require("interfaces/header.php"); ?>
        <script>
            function showCartContainer(){
                document.getElementById("cart_container").style.display="block";
                var t=document.getElementById("productCart").childElementCount;
                if(t>4){
                    document.getElementById("titleCart").style.width="98.7%";
                    document.getElementById("XSign_cart").style.color="black";
                }
                else{
                    document.getElementById("titleCart").style.width="100%";	
                    document.getElementById("XSign_cart").style.color="white";
                }
            }
	    </script>
        <!-- content -->
        <div class="content">
            <?php
                include ("interfaces/cart.php");
        		include("interfaces/deliveryinfor.php");
                if(!isset($_GET['manage'])) {
                    require("interfaces/all_products.php");
                }
                else if ($_GET['manage'] == 'detail') {
                    require("interfaces/product_detail.php");
                }
                else if ($_GET['manage'] == 'search') {
                    require('interfaces/search.php');
                }
                else if($_GET['manage']=='user'){
                    require("interfaces/user.php");
                }
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