<?php
    $file_name = $_GET['filename'];
    $file_path = '../images/products/' . $file_name;
    if (file_exists($file_path)) {
        header ('Content-Type: image/png');
        readfile($file_path);
    }
    else {
        echo "404 Not Found";
    }
?>