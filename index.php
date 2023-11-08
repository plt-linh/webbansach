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
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->

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
        <!-- navigation -->
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
        <?php require("interfaces/navigation.php"); ?>
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
    </div>
   
    
</body>
</html>