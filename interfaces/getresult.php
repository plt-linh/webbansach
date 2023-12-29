<?php
include("../db/MySQLConnect.php");

// Lấy giá trị của category và supplier từ tham số GET
$category = isset($_GET['category']) ? $_GET['category'] : '';
$supplier = isset($_GET['supplier']) ? $_GET['supplier'] : '';

// Xây dựng câu truy vấn dựa trên giá trị của category và supplier
$sql = "SELECT * FROM products WHERE 1 ";

if (!empty($category)) {
    $categories = explode(',', $category);
    $sql .= "AND CATEGORY IN ('" . implode("','", $categories) . "') ";
}

if (!empty($supplier)) {
    $suppliers = explode(',', $supplier);
    $sql .= "AND SUPPLIER IN ('" . implode("','", $suppliers) . "') ";
}

$result = mysqli_query($connect, $sql);

// Xử lý kết quả và tạo HTML
while ($row = mysqli_fetch_array($result)) {
    ?>

    <div class="book col-md-3 mt-3">
        <div class="thumbnail text-center">
            <a href="index.php?manage=detail&product_id=<?php echo $row['PRODUCT_ID']; ?>">
                <img class="mt-2" src="images/products/<?php echo $row['IMAGE_URL']; ?>" alt="<?php echo $row['PRODUCT_NAME']; ?>" style="width:100%">
            </a>
            <div class="caption mt-2">
                <h5><?php echo $row['PRODUCT_NAME']; ?></h5>
                <h5 style="color:red; "><?php echo number_format($row['PRICE'], 0, '', ' ') . " ₫"; ?></h5>
            </div>
        </div>
    </div>
    <?php
}
?>
