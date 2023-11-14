<?php
    include "../db/MySQLConnect.php";

    if(isset($_POST['btn'])) {
        $id = "";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = 3;

        $sql = "INSERT INTO accounts(ACCOUNT_ID, USERNAME, PASSWORD, PERMISSION_GROUP_ID)
        VALUES ('$id', '$username', '$password', '$level')";

        mysqli_query($connect, $sql);
        
        header("location:../interfaces/login.php");
    }

?>
<form action="register.php" method="post">
    <label>username</label>
    <input type="text" name="username">

    <label>password</label>
    <input type="password" name="password">
    <button type="submit" name="btn">Đăng ký</button>
</form>