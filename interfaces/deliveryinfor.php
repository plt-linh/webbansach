<?php 
	$checkPay=0;
	$connect =new mysqli("localhost","root","","website");
	$connect -> set_charset("utf8");
	require_once("dbcontroller.php");
	$db_handle = new DBController();

	if(isset($_SESSION['customer_name'])){	//Lay thong tin khach hang
		$username=$_SESSION['customer_name'];
		$inforUser=$db_handle->runQuery("SELECT k.CUSTOMER_ID, k.ADDRESS, k.PHONE FROM customers as k INNER JOIN accounts as t ON k.ACCOUNT_ID=t.ACCOUNT_ID AND k.CUSTOMER_NAME='$username'");
		$idUser=$inforUser[0]["CUSTOMER_ID"];
		$address=$inforUser[0]["ADDRESS"];
		$phone=$inforUser[0]["PHONE"];
	}

	if(isset($_POST["delivery"])){	//ghi du lieu xuong database
		date_default_timezone_set('Asia/Ho_Chi_Minh');	
		$dateBuy=date("Y-m-d h:i:s");
		$queryHD="INSERT INTO orders(CUSTOMER_ID, ADDRESS, PHONE, STATUS, TOTAL_PRICE, DATE)";
		$queryHD.=" VALUES('" .$idUser. "', '" .$_POST["address_delInfor"]. "', '" .$_POST["phone_delInfor"]. "', 0, '" .$total_price. "', '" .$dateBuy. "')"; 
		$checkPay=mysqli_query($connect,$queryHD);
		$getIDnew=$db_handle->runQuery("SELECT ORDER_ID FROM `orders` ORDER BY `orders`.`ORDER_ID` DESC");
		$IDnew=$getIDnew[0]["ORDER_ID"];
		foreach($_SESSION["cart_item"] as $k=>$v){
			$getInventory=$db_handle->runQuery("SELECT QUANTITY FROM products WHERE PRODUCT_ID='".$_SESSION["cart_item"][$k]["id"]."'");
			$inventory=$getInventory[0]["QUANTITY"];
			$newQuanlity=$inventory-$_SESSION["cart_item"][$k]["quantity"];
			$totalprice=($_SESSION["cart_item"][$k]["price"])*$_SESSION["cart_item"][$k]["quantity"];
			$queryCT="INSERT INTO order_detail(ORDER_ID, PRODUCT_ID, QUANTITY, PRICE, TOTAL_PRICE)";
			$queryCT.=" VALUES('" .$IDnew. "', '" .$k. "', '" .$_SESSION["cart_item"][$k]["quantity"]. "', '" 
			.$_SESSION["cart_item"][$k]["price"]. "', '" .$totalprice. "')";
			$checkPay=mysqli_query($connect,$queryCT);
			mysqli_query($connect,"UPDATE products SET QUANTITY=$newQuanlity WHERE PRODUCT_ID='".$_SESSION["cart_item"][$k]["id"]."'");
		}
	}
?>
<style>
	#delInfor_container{
		width:25%;
		height:270px;
		background-color:white;
		box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		margin:110px 0 0 37.5%;
		position:fixed;
		z-index:11;
		display:none;
		top:150px;
	}
	#delInfor_container input[type=text]{
		width:90%;
	}
	#delInfor_XSign{
		position:absolute;
		margin-left:97%;
		cursor:pointer
	}
	#delInfor_title{
		width:100%;
		height:50px;
		background-color:#09F;
		color:white;
		text-align:center;
		position:relative
	}
	#btPay{
		background-color:#09F; 
		color:white; 
		border:solid 2px black
	}
	#btPay:active{
		background-color:blue;
	}	
</style>
<script>
	function checkDelInfor(){
		var address, phone;
		address = document.getElementById("txAddress_delInfor").value;
		phone = document.getElementById("txPhone_delInfor").value;

		if (address == "") {
			alert("Vui lòng nhập địa chỉ");
			return 0;
		}

		if (phone == "") {
			alert("Vui lòng nhập số điện thoại");
			return 0;
		}

		var patt = /^\d+/;
		if (!phone.match(patt)) {
			alert("Số điện thoại không hợp lệ");
			return 0;
		}

		// Kiểm tra tổng tiền
		var total_price = <?php echo $total_price; ?>;
		if (total_price <= 0) {
			alert("Tổng tiền phải lớn hơn 0");
			return 0;
		}

		delInfor_form.submit();
	}

	function hideDelInfor() {
		document.getElementById("delInfor_container").style.display = "none";
	}
</script>
<div id="delInfor_container">
	<div id="delInfor_title">
    	<div id="delInfor_XSign" onclick="hideDelInfor()">X</div>
    	<h5 style="color:white; line-height:50px">THÔNG TIN GIAO HÀNG</h5>
    </div>
    <div style="text-align:left; margin-left:30px">
        <form id="delInfor_form" action="<?php echo  $_SERVER['REQUEST_URI']; ?>" method="post">
        	<input type="hidden" name="delivery" value="1">
            <div style="margin-top:20px"><b>Địa chỉ:</b></div>
            <input id="txAddress_delInfor" name="address_delInfor" type="text" >
            <div style="margin-top:10px"><b>Số điện thoại:</b></div>		
            <input id="txPhone_delInfor" name="phone_delInfor" type="text" > 
      	</form>
    </div>
    <div style="margin-top:25px; text-align:center">
        	<button id="btPay" onClick="checkDelInfor()" >Thanh toán</button>
    </div>
</div>
<script>
	function loadInfor(){
		var address, phone;
		address="<?php
			if(isset($_SESSION['customer_name']))
				echo $address;
		?>";
		phone="<?php 
			if(isset($_SESSION['customer_name']))
				echo $phone;
		?>";
		document.getElementById("txAddress_delInfor").value=address;
		document.getElementById("txPhone_delInfor").value=phone;
	}
	loadInfor();
	if(<?php echo "$checkPay"?>)
		alert("Cảm ơn quý khách đã mua hàng");
</script>
