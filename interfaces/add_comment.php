<?php
session_start();
include "../db/MySQLConnect.php";

if (isset($_SESSION['customer_name'])) {
    if (isset($_POST['btn'])) {
        $product_id = $_GET['product_id'];
        $content = $_POST['content'];
        $name = $_SESSION['customer_name'];
        $imagec = $_FILES['imgc']['name'];
        $image_tmp_name = $_FILES['imgc']['tmp_name'];

        $imagec_type = $_FILES['imgc']['type'];
        $imagec_size = $_FILES['imgc']['size'];

        if (empty($imagec)) {
            echo "<script>alert('Chọn một hình ảnh')</script>";
            echo '<script>window.history.back();</script>';
        } else {
            // Allow only JPEG and PNG formats
            $allowed_formats = ['image/jpeg', 'image/png'];
            if (in_array($imagec_type, $allowed_formats) && $imagec_size < 1000000) {
                $sql = "INSERT INTO comment(COMMENT_ID, CONTENT, PRODUCT_ID, USER, IMAGE)
                        VALUES (NULL, '$content', '$product_id', '$name', '$imagec')";

                mysqli_query($connect, $sql);

                if (!move_uploaded_file($image_tmp_name, '../images/comments/' . $imagec)) {
                    echo '<pre>Đánh giá không thành công</pre>';
                } else {
                    echo "Đánh giá thành công";
                }

                header("location:../index.php?manage=detail&product_id=$product_id");
            } else {
                echo 'Chỉ được tải file JPEG hoặc PNG và kích thước tối đa là 1MB';
            }
        }
    }
} else {
    echo '<script>alert("Đăng nhập để bình luận");</script>';
    echo '<script>window.history.back();</script>';
}
?>
