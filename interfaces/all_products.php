<?php
include("db/MySQLConnect.php");
$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);
?>
<?php
    $queryCategory = "SELECT DISTINCT CATEGORY FROM products";
    $querySupplier = "SELECT DISTINCT SUPPLIER FROM products";
    $getCategory=mysqli_query($connect,$queryCategory);
    $getSupplier=mysqli_query($connect,$querySupplier);
?>
<script>
    function getresult(url) {
        $.ajax({
            url: url,
            type: "GET",
            data:  {rowcount:$("#rowcount").val()},
            success: function(data){
                $("#pagination-result").html(data);
            }        
        });
    }
</script>

<div class="container-fluid index row g-2">

    <div class="left-container row col-3 ">
        <script>
            getresult("interfaces/getresult.php<?php
                $check=isset($_GET['type']);
                if($check) {
                    $type=$_GET['type'];
                    echo "?type=$type";
                }
            ?>")
        </script>
        <div class="side-bar p-sm-4 p-3">
            <!-- category filter -->
            <div class="category border-bottom py-2">
                <h5 class="text-secondary">Danh mục sản phẩm</h5>
                <a>
                    <?php
                        while($row_type_product=mysqli_fetch_array($getCategory)){
                    ?>
                    <label>
                        <input type="checkbox" class="type" value="<?php echo $row_type_product['CATEGORY']; ?>">
                        <span class="span"><?php echo $row_type_product['CATEGORY'] ?> </span>
                    </label>
                    <br>
                    <?php
                        }
                    ?>
                </a>
            </div>
            <!-- price filter-->
            <div class="range border-bottom py-3">
                <h5 class="text-secondary">Chọn khoảng giá</h5>
                <form class="row g-3">
                    <div class="col-auto">
                        <input class="form-control form-control-sm" id="min_price" type="text" placeholder="0"/>
                    </div>
                    <div class="col-auto" type="plaintext">-</div>
                    <div class="col-auto">
                        <input class="form-control form-control-sm" id="min_price" type="text" placeholder="0"/>
                    </div>
                </form>
            </div>
            <!-- supplier filter -->
            <div class="left-side border-bottom py-3">
                <h5 class="text-secondary">Nhà xuất bản</h5>
                <a>
                    <?php
                        while($row_supplier_product=mysqli_fetch_array($getSupplier)){
                    ?>
                    <label>
                        <input type="checkbox" class="supplier" value="<?php echo $row_supplier_product['SUPPLIER']; ?>">
                        <span class="span"><?php echo $row_supplier_product['SUPPLIER'] ?> </span>
                    </label>
                    <br>
                    <?php
                        }
                    ?>
                </a>
            </div>
        </div>
    </div>

    <div class="right-container row col-9">
        <?php
        while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="book col-md-3 mt-3">
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