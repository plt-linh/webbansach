<?php
$connect = new mysqli("localhost", "root", "", "website");
$connect->set_charset("utf8");

if ($connect->connect_error) {
    die("Kết nối tới MySQL thất bại: " . $connect->connect_error);
}

require_once("dbcontroller.php");
$db_handle = new DBController();

if (!empty($_POST["cart"])) {
    switch ($_POST["cart"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE PRODUCT_ID='" . $_GET["product_id"] . "'");
                $product_id = $_GET["product_id"];
                $price = $productByCode[0]["PRICE"];
                $itemArray = array(
                    $productByCode[0]["PRODUCT_ID"] => array(
                        'id' => $product_id,
                        'image' => $productByCode[0]["IMAGE_URL"],
                        'name' => $productByCode[0]["PRODUCT_NAME"],
                        'price' => $price,
                        'quantity' => $_POST["quantity"]
                    )
                );

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["PRODUCT_ID"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["PRODUCT_ID"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] += $itemArray;
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_POST["product"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

$total_price = "";
if (isset($_SESSION["cart_item"])) {
    $total_price = 0;
}
?>

<script>
    function checkLogin() {
        var check = <?php
                        if (isset($_SESSION['login'])) {
                            if ($_SESSION['login'] == true) {
                                if (isset($_SESSION["cart_item"]))
                                    echo 0;
                                else
                                    echo 2;
                            } else echo 1;
                        } else echo 1;
                        ?>;
        switch (check) {
            case 0:
                document.getElementById("delInfor_container").style.display = "block";
                break;
            case 1:
                alert("Vui lòng đăng nhập");
                break;
            case 2:
                alert("Giỏ hàng rỗng");
                break;
        }
    }

    function hideCartContainer() {
        document.getElementById("cart_container").style.display = "none";
    }
</script>

<div id="cart_container">
    <div class="XSign" id="XSign_cart" onclick="hideCartContainer()">x</div>
    <div id="titleCart">
        <div style="width:30%; float:left; text-align:center"><b>SẢN PHẨM</b></div>
        <div style="width:15%; float:left; text-align:center"><b>ĐƠN GIÁ</b></div>
        <div style="width:12.5%; float:left; text-align:center"><b>SỐ LƯỢNG</b></div>
        <div style="width:15%; float:left; text-align:center"><b>THÀNH TIỀN</b></div>
        <div style="width:15%; float:left"><b>THAO TÁC</b></div>
    </div>
    <div id="productCart">
        <?php
        if (isset($_SESSION["cart_item"]))
            foreach ($_SESSION["cart_item"] as $item) {
                $item_price = $item["quantity"] * $item["price"];
                $total_price += $item_price;
        ?>
                <div class="rowCart">
                    <div class="colCart1">
                        <div class="imgCart"><img src="images/products/<?php echo $item["image"]; ?>" /></div>
                        <div class="nameCart"><?php echo $item["name"]; ?></div>
                    </div>
                    <div class="colCart3">
                        <div style="margin-top:25px"><?php echo $item["price"]; ?></div>
                    </div>
                    <div class="colCart4"><?php echo $item["quantity"]; ?></div>
                    <div class="colCart5">
                        <div style="margin-top:25px;"></div><?php echo $item_price; ?>
                    </div>
                    <div class="colCart6">
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                            <input type="hidden" name="cart" value="remove">
                            <input type="hidden" name="product" value="<?php echo $item["id"] ?>" />
                            <button type="submit" class="removeP"><i class="fa fa-trash-o" style="font-size:36px"></i></button>
                        </form>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
    <div id="footerCart" class="row">
        <div class="col-md-6 col-sm-6">
            <div style="margin:0 1% 0 20%; float:left"><b>Tổng Đơn: <?php if ($total_price != "") echo "$total_price VNĐ"; else echo $total_price; ?></b></div>
            <div style="float:left" id="totalBill"></div>
        </div>
        <div class="col-md-6 col-sm-6">
            <button class="btn btn-ouline-success" onclick="checkLogin()">Đặt Hàng</button>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <input type="hidden" name="cart" value="empty">
                <button type="submit" class="btn btn-ouline-warning">Làm Trống</button>
            </form>
        </div>
    </div>
    <br>

</div>

<style>
	#cart_container{
		width:80%;
		height:auto;
		background-color:white;
		box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		margin-left:10%;
		position:fixed;
		z-index:10;
		overflow:auto;
		display:none;
		top:150px
	}
	#titleCart{
		width:100%;	
		height:48px;
		line-height:48px;
		background-color:#4CAF50;
		color:white;
		border-bottom:solid 2px #000
	}
	#productCart{
		width:100%;
		height:400px;
		overflow:auto
	}
	#footerCart{
		width:100%;
		height:48px;
		line-height:48px;
		border-top:solid 2px #000
	}
	#footerCart button{
		float:right;
		margin-top:12px;
		background:none;
		border:solid 2px #000;
		color:#000;
		font-size:16px
	}
	.rowCart{
		width:100%;
		height:100px;
		background-color:none
	}
	.colCart1{
		width:30%;
		height:100px;
		line-height:100px;
		float:left;
	}
	.imgCart img{
		width:13%;
		height:60px;
		margin:20px 0 0 5%;
		float:left;
		border:solid 1px #eee;
		box-shadow: 2px 2px 3px #ddd;
	}
	.nameCart{
		width:79%;
		margin-left:3%;
		float:left;
	}
	.colCart2{
		width:10%;
		height:100px;
		line-height:100px;
		float:left;
		text-align:center;
	}
	.colCart3{
		width:12.5%;
        line-height:50px;
		height:100px;
		float:left;
		text-align:center;
	}
	.colCart4{
		width:15%;
		height:100px;
		line-height:100px;
		float:left;
		text-align:center;
	}
	.colCart4 input[type=text]
	{
		overflow:hidden;
		position:relative;
		height:2.2rem;
		width:1.9rem;
		padding:0;
		text-align:center
	}
	.colCart5{
		width:12.5%;
		height:100px;
        line-height:50px;
		float:left;
		text-align:center;
	}
	.colCart6{
		width:10%;
		height:100px;
		line-height:100px;
		float:left;
		text-align:center;
	}
	.colCart6 a{
		text-decoration:none;
		color:#000;
	}
	.removeP{
		font-size:18px;
		
		cursor:pointer;
	}
	.XSign{
		color:red; 
		width:4%;
        height:15px;
		font-weight:bold;
		font-size:30px;
		line-height:15px;
		text-align:center;
		position:absolute;
		margin:1% 0 0 94%;
		cursor:pointer
    }
</style>