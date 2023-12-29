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

    session_start();

    function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Tạo chuỗi ngẫu nhiên
        }
    }

    generateCsrfToken();
    

    if(isset($_POST['login'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token không hợp lệ");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        //thực hiện truy vấn dữ liệu
        $sql = "SELECT * FROM accounts WHERE USERNAME = '$username' AND PASSWORD = '$password' ";
        $result = mysqli_query($connect,$sql);


        // $sql = "SELECT * FROM accounts WHERE USERNAME = ? AND PASSWORD = ?";
        // $stmt = $connect->prepare($sql);
        // $stmt->bind_param("ss", $username, $password);
        // $stmt->execute();
        // $result = $stmt->get_result();




        $checkname = "SELECT FULL_NAME FROM accounts WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $resultname = mysqli_query($connect,$checkname);
        $data = array();
        while($row = mysqli_fetch_array($result,1)) {
            $data[]=$row;
        }

        $fullname = mysqli_fetch_assoc($resultname);
        $name = $fullname['FULL_NAME'];
        
        $connect -> close();

        if($data != null && count($data) > 0) {
            $_SESSION['customer_name'] = $name;
            $_SESSION['login'] = true;
            $_SESSION['last_activity'] = time();

            header("location:../index.php");
        }
        else {
            $_SESSION['login']=false;
            echo '<script>alert("Tài khoản hoặc mật khẩu không chính xác");</script>';
            echo '<script>window.history.back();</script>';
        }
        
    }
?>
<div class="main">
    <form action="login.php" method="POST">
        <h3 class="text-center">ĐĂNG NHẬP</h3>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="text-center">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button class="btn btn-success" type="submit" name="login">Đăng nhập</button>
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
