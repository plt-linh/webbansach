<?php
include("db/MySQLConnect.php");
$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);
?>
<div class="right-container">
    <div class="row">
        <?php
        while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="book col-md-3 col-sm-4 mt-3">
            <div class="thumbnail text-center">
                <a href="product_detail.php?product_id=<?php echo $row['PRODUCT_ID']; ?>">
                    <img class="mt-2" src="images/products/<?php echo $row['IMAGE_URL'];?>" alt="<?php echo $row['PRODUCT_NAME'];?>" style="width:100%">
                </a>
                <div class="caption mt-2">
                    <h5><?php echo $row['PRODUCT_NAME'];?></h5>
                    <h5 style="color:red; "><?php echo number_format($row['PRICE'], 0, '', ' ') . " VNĐ";?></h5>
                </div>
            </div>
        </div>
        <?php       
        }
        ?>
    </div>
</div>
<style>
    .thumbnail {
        background-color: white;
        width: 100%;
        height: 100%;
    }
</style>