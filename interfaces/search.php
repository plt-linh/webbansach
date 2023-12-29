

<?php
    $connect =new mysqli("localhost","root","","website");
    $connect -> set_charset("utf8");

    // function cleanInput($input) {
    //     $input = preg_replace("/[^a-zA-Z0-9_\s]/", "", $input);
    //     return $input;
    // }

	if(isset($_POST['search_submit']) ){
        $key=$_POST['search_product'];

        // $key = cleanInput($_POST['search_product']); 

        $sql="SELECT PRODUCT_NAME, PRICE, IMAGE_URL, PRODUCT_ID from products WHERE PRODUCT_NAME LIKE '%$key%'";
    }
    if(mysqli_fetch_array(mysqli_query($connect,$sql))==null) { $noresult= "Không tìm thấy sản phẩm";}
    else {
        $noresult="";
    }
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
<div class="ads-grid py-sm-5 py-4 all-product ">
        <div class="text-center title">
            <span class="text-center">Kết quả tìm kiếm của: <strong><?php echo '"' .$key .'"'?></strong></span>
        </div>
        <h4 class="text-center" style="color:grey; margin-top: 20px" ><?php echo $noresult ?> </h4>
        <div class="row">
        <?php
            $connect = new mysqli("localhost", "root", "", "website");
            $connect->set_charset("utf8");

            $key = $_POST['search_product'];

            // $key = cleanInput($_POST['search_product']);

            $sql = "SELECT PRODUCT_NAME, PRICE, IMAGE_URL, PRODUCT_ID FROM products WHERE PRODUCT_NAME LIKE '%$key%'";

            $getAllProduct = mysqli_query($connect, $sql);

            $output = '';

            while ($row_all_product = mysqli_fetch_array($getAllProduct)) {
                $output .= "<div class=\"book col-md-3 mt-3\" style=\"background-color:white\">
                                    <div class=\"thumbnail text-center\">
                                        <a href=\"index.php?manage=detail&product_id={$row_all_product['PRODUCT_ID']}\">
                                            <img class=\"mt-2\" src=\"images/products/{$row_all_product['IMAGE_URL']}\" style=\"width:100%\">
                                        </a>
                                        <div class=\"caption mt-2\">
                                            <h5>{$row_all_product['PRODUCT_NAME']}</h5>
                                            <h5 style=\"color:red;\">{$row_all_product['PRICE']}</h5>
                                        </div>
                                    </div>
                                </div>";
            }
            print $output;
        ?>
        </div>
</div>



