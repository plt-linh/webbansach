<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    
</head>
<body>
<?php
    include "../db/MySQLConnect.php";

    if(isset($_POST['register'])) {
        $id = "";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
        $fullname = $_POST['fullname'];
        $level = 3;

        // $checkusername="SELECT * FROM accounts WHERE USERNAME ='".$username"'";

        $sql = "INSERT INTO accounts(ACCOUNT_ID, USERNAME, PASSWORD, PERMISSION_GROUP_ID, FULL_NAME)
        VALUES ('$id', '$username', '$password', '$level', '$fullname')";
        $getMaTK="SELECT ACCOUNT_ID FROM `accounts` WHERE USERNAME ='$username'";

        $data=array();
         if($data == null){ 
            // $getAccountId = "SELECT ACCOUNT_ID FROM `accounts` WHERE "
            mysqli_query($connect, $sql);

            $MA_TK = mysqli_fetch_assoc(mysqli_query($connect,$getMaTK));
            $query1= "INSERT INTO customers (CUSTOMER_NAME,ACCOUNT_ID) VALUE('".$fullname."','".$MA_TK['ACCOUNT_ID']."')";      
            $result=mysqli_query($connect,$query1);  
            header("location:../interfaces/login.php");
         }

    }

?>
<div class="main">
    <form action="register.php" method="post">
        <h3 class="text-center">ĐĂNG KÝ</h3>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control">
        </div>
        <div class="text-center">
            <button class="btn btn-success"type="submit" name="register">Đăng Ký</button>
        </div>
    </form>
</div>
</body>
</html>

<style>
    .main {
        min-height: 100vh;
        margin-top: 100px;
        display: flex;
        justify-content: center;
        /* background-image: url(../images/background_login.jpg); */
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
    }
    .form-group {
        display: flex;
        margin-bottom: 16px;
        flex-direction: column;
    }
    .form-control {
        height: 40px;
        padding: 8px 12px;
        border: 1px solid #b3b3b3;
        border-radius: 3px;
        outline: none;
        font-size: 1.4rem;
    }
</style>