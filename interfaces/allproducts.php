<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <?php
        include ("db/MySQLConnect.php");
        $sql = "SELECT * FROM products";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_array($result)) {
    ?>
        <h1><?php echo $row['PRODUCT_ID'];?> </h1>
    <?php       
        }
    ?>
</body>
</html>