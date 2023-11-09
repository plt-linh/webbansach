<?php
    // include ("../../../db/MySQLConnect.php");
    $connect = mysqli_connect("localhost", "root", "", "website");
    if( isset($_POST['btn'])) {
        $name= $_POST['name'];
        $author= $_POST['author'];
        $category= $_POST['category'];
        $supplier= $_POST['supplier'];
        $quantity= $_POST['quantity'];
        $price= $_POST['price'];
        $description= $_POST['description'];
        $image= $_FILES['img']['name']; //lấy hình ảnh gửi lên db
        $image_tmp_name= $_FILES['img']['tmp_name']; //lấy đường dẫn ảnh

        $sql = "INSERT INTO products (PRODUCT_NAME, AUTHOR, CATEGORY, SUPPLIER, QUANTITY, PRICE, DESCRIPTION, IMAGE_URL)
                VALUE ('$name', '$author', '$category', '$supplier', '$quantity', '$price', '$description', '$image')";
        
        mysqli_query($connect, $sql);

        move_uploaded_file($image_tmp_name, '../../images/products/' . $image); // chuyển hình ảnh vào thư mục
}
?>
<form action="add_product.php" method="POST" enctype="multipart/form-data">
    <p>Name</p>
    <input type="text" name="name">
    <p>Tác giả</p>
    <input type="text" name="author">
    <p>Thể loại</p>
    <input type="text" name="category">
    <!-- <select name="category" id="category"></select> -->
    <p>Nhà cung cấp</p>
    <input type="text" name="supplier">
    <p>số lượng</p> 
    <input type="text" name="quantity">
    <p>giá</p>
    <input type="text" name="price">
    <p>mô tả</p>
    <input type="text" name="description">
    <p>Image</p>
    <input type="file" name="img">
    <button id="submit" name="btn">Thêm</button>
</form>