<?php
    include "../db/MySQLConnect.php";

    session_start();

    // if(isset($_SESSION['customer_name'])) {
    //     header("location:test.php");
    // }



    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM accounts WHERE USERNAME = '$username' AND PASSWORD = '$password' ";

        $result = mysqli_query($connect,$sql);

        if(mysqli_num_rows($result) == 1) {
            $_SESSION['customer_name'] = $username;
            $_SESSION['login'] = true;
            header("location:../index.php");
        }
        else {
            $_SESSION['login']=false;
        };

    }
?>

<form action="login.php" method="POST">
    <label>Username</label>
    <input type="text" name="username">

    <label>Password</label>
    <input type="password" name="password">

    <button type="submit" name="login">Đăng nhập</button>
</form>