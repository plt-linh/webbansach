<style>
html{
	scroll-behavior: smooth;
}
.link{
	padding: 10px 15px;
	background: transparent;
	border:#bccfd8 1px solid;
	border-left:0px;
	cursor:pointer;
	color:#607d8b
}
.disabled{
	cursor:not-allowed;
	color: #bccfd8;
}
.current{
	background: #bccfd8;
}
.first{
	border-left:#bccfd8 1px solid;
}
#pagination{
	margin-top: 20px;

	padding-top: 30px;
	border-top: #F0F0F0 1px solid;
}
#pagination a{
	text-decoration:none;
}
#paginationWrapper{
	width:100%;
	text-align:center
}
.dotSign{
	padding:10px 13px;
	background:none;
	border-right: #bccfd8 1px solid;
}
</style>
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
<!-- all products-->
<div class="ads-grid py-sm-3 py-2 all-product">
    <div class="row">
        <script>
            getresult("interfaces/getresult.php<?php
                $check=isset($_GET['type']);
                if($check) {
                    $type=$_GET['type'];
                    echo "?type=$type";
                }
            ?>")
        </script>
        <!-- product filter -->
        <div class="category-filter col-md-3 mt-lg-0 p-lg-0">
            <div class="side-bar p-sm-4 p-3">
                <!-- category filter -->
                <div class="category border-bottom py-2">
                    <h5 class="text-secondary">Danh mục sản phẩm</h5>
                    <a>
                        <?php
                            while($row_type_product=mysqli_fetch_array($getCategory)){
                        ?>
                        <li>
                            <input type="checkbox" class="type" value="<?php echo $row_type_product['CATEGORY']; ?>">
                            <span class="span"><?php echo $row_type_product['CATEGORY'] ?></span>
                        </li>
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
                        <li>
                            <input type="checkbox" class="supplier" value="<?php echo $row_supplier_product['SUPPLIER']; ?>">
                            <span class="span"><?php echo $row_supplier_product['SUPPLIER'] ?></span>
                        </li>
                        <?php
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>
        <!-- product results -->
        <div id="pagination-result" class="col-md-9 col-sm-12 row product">
            <input type="hidden" name="rowcount" id="rowcount">
        </div>              
    </div>
</div>
 <script>
    funtion filter_data() {
        $('#pagination-result').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var name = $('#name').val();
        var minium_price = $('#min_price').val();
        var maximum_price = $('#max_price').val();
        var type = get_filter('type');
        var supplier = get_filer('supplier');
        $.ajax({
            url:"interfaces/fetch_data.php <?php
                $check=isset($_GET['type']);
                if($check){
                    $type=$_GET['type'];
                    echo "?type=$type";
                }
            ?>",
            method:"POST",
            data:{action:action, name:name, minium_price:minium_price, maximum_price:maximum_price, typePro:type, supplier:supplier},
            success:function(data){
                $('#pagination-result').html(data);
            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

	function validatePrice(){
		var patt=/^\d+/;
		var minPrice=$("#min_price").val();
		var maxPrice=$("#max_price").val();
		if(minPrice!="" || maxPrice!="")
			if(!minPrice.match(patt) || !maxPrice.match(patt)){
			alert("Khoảng giá không hợp lệ");
			return 0;
			}
		if(minPrice==0)
			$("#min_price").val('00');	
		if(maxPrice==0)
			$("#max_price").val('00');
		filter_data();
    }

 </script>