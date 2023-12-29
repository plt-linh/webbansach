<?php
    $connect = new mysqli('localhost','root','', 'website');
    $connect -> set_charset("utf8");
    //kiểm tra kết nối 
    if($connect->connect_error){
        var_dump($connect->connect_error);
        echo "\n Kết Nối DB thất bại";
        die();
    }
    else echo "";
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

    <div class="left-container row col-lg-2 col-sm-3 col-md-3">
        <script>
            getresult("interfaces/getresult.php<?php
                $check=isset($_GET['type']);
                if($check) {
                    $type=$_GET['type'];
                    echo "?type=$type";
                }
            ?>")
        </script>
        <from class="side-bar p-sm-4 p-3" id="form-search-product" method="POST">
            <!-- category filter -->
            <div class="category border-bottom py-2">
                <h5 class="text-secondary">Danh mục sản phẩm</h5>
                <a>
                    <?php
                        while($row_type_product=mysqli_fetch_array($getCategory)){
                    ?>
                    <label>
                        <input type="checkbox" class="type" id="category" value="<?php echo $row_type_product['CATEGORY']; ?>">
                        <span class="span"><?php echo $row_type_product['CATEGORY'] ?> </span>
                    </label>
                    <br>
                    <?php
                        }
                    ?>
                </a>
            </div>
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
        </from>
    </div>

    <div class="right-container row col-lg-10 col-sm-9">
        <?php
        while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="book col-md-3 mt-3">
            <div class="thumbnail text-center">
                <a href="index.php?manage=detail&product_id=<?php echo $row['PRODUCT_ID']; ?>">
                    <img class="mt-2" src="images/products/<?php echo $row['IMAGE_URL'];?>" alt="<?php echo $row['PRODUCT_NAME'];?>" style="width:100%">
                </a>
                <div class="caption mt-2">
                    <h5><?php echo $row['PRODUCT_NAME'];?></h5>
                    <h5 style="color:red; "><?php echo number_format($row['PRICE'], 0, '', ' ') . " ₫";?></h5>
                </div>
            </div>
        </div>
        <?php       
        }
        ?>
    </div>

</div>

<script>
    $(document).ready(function() {
        // Sự kiện change cho checkbox category
        $('.type').change(function() {
            handleCheckboxChange();
        });

        // Sự kiện change cho checkbox supplier
        $('.supplier').change(function() {
            handleCheckboxChange();
        });

        function handleCheckboxChange() {
            // Tạo một đối tượng để lưu trữ giá trị của checkbox
            var filters = {
                category: [],
                supplier: []
            };

            // Lặp qua tất cả checkbox category
            $('.type:checked').each(function() {
                filters.category.push($(this).val());
            });

            // Lặp qua tất cả checkbox supplier
            $('.supplier:checked').each(function() {
                filters.supplier.push($(this).val());
            });

            // Gọi hàm AJAX với các giá trị của checkbox
            getresult("interfaces/getresult.php?category=" + filters.category.join(',') + "&supplier=" + filters.supplier.join(','));
        }

        function getresult(url) {
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $(".right-container").html(data);
                }
            });
        }
    });
</script>
<style>
    .thumbnail {
        background-color: white;
        width: 100%;
        height: 100%;
    }
</style>