<?php

    include "../../db/MySQLConnect.php";

    $id = $_GET['id'];


    $sql = "SELECT * FROM products WHERE PRODUCT_ID = " . $id;

    $querry = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($querry);

    //Xử lý nút Edit
    if(isset($_POST['btn'])) {
        $name = $_POST['name'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $supplier = $_POST['supplier'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name']; // chỉ lấy tên hình ảnh để đăng lên db
        $image_tmp_name =$_FILES['image']['tmp_name']; //tmp_name để lấy đường dẫn của hình ảnh

        $sql = "UPDATE products SET PRODUCT_NAME='$name', AUTHOR='$author', CATEGORY='$category', SUPPLIER='$supplier', QUANTITY='$quantity', PRICE='$price', IMAGE_URL='$image'
        WHERE PRODUCT_ID=".$id;

        mysqli_query($connect,$sql);

        move_uploaded_file($image_tmp_name, '../../images/products/'.$image);
        header('location: ../index.php ');
    }
    
?>
<h1>Sản phẩm: <?php echo $row['PRODUCT_NAME'];?></h1>
<form method="POST" enctype="multipart/form-data">

    <p>Name</p>
    <input type="text" name="name" value = "<?php echo $row['PRODUCT_NAME'];?>">
    <p>Tác giả</p>
    <input type="text" name="author" value = "<?php echo $row['AUTHOR'];?>">
    <p>Thể loại</p>
    <input type="text" name="category" value = "<?php echo $row['CATEGORY'];?>">
    <!-- <select name="category" id="category"></select> -->
    <p>Nhà cung cấp</p>
    <input type="text" name="supplier" value = "<?php echo $row['SUPPLIER'];?>">
    <p>số lượng</p> 
    <input type="text" name="quantity" value = "<?php echo $row['QUANTITY'];?>">
    <p>giá</p>
    <input type="text" name="price" value = "<?php echo $row['PRICE'];?>">
    <p>mô tả</p>
    <input type="text" name="description" value = "<?php echo $row['DESCRIPTION'];?>">
    <p>Image</p>
    <span>
        <img src="../../images/products/<?php echo $row['IMAGE_URL'];?>" width="100px" height="100px" >
    </span>
    <input type="file" name="image">

    <button id="submit" name="btn">Sửa</button>
</form>
<style>
    .title_left {
        font-size: 18pt;
    }
    .list-product {
	font-family: 'Arial';
    color: rgb(143, 143, 163);
    background-color: aliceblue;
    width: 100%;
    height: 100%;
    }
    .container .row {
        width: 100%;
        height: 100%;
    }
    .p-panel {
        font-size: 14pt;
    }
    .table {
        font-size: 12px;
        color: grey;
    }
</style>