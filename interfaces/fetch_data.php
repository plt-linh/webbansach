<?php

//fetch_data.php
$connect =new mysqli("localhost","root","","website");
$connect -> set_charset("utf8");
require_once("dbcontroller.php");
$db_handle = new DBController();

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM producrs  
	";
	if(isset($_POST["name"]))
	{
		$query .= "
		 WHERE PRODUCT_NAME LIKE '%".$_POST["name"]."%'
		";
	}
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND PRICE BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["typePro"]))
	{
		$type_filter = implode("','", $_POST["typePro"]);
		$query .= "
		 AND CATEGORY IN('".$type_filter."')
		";
	}
	if(isset($_POST["supplier"]))
	{
		$supplier_filter = implode("','", $_POST["supplier"]);
		$query .= "
		 AND SUPPLIER IN('".$supplier_filter."')
		";
	}
	$query .= "
		 GROUP BY PRODUCT_NAME
		";
	
	$result = $db_handle->runQuery($query);
	$total_row = $db_handle->numRows($query);
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$getSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `discountproduct` WHERE PRODUCT_ID='".$row["PRODUCT_ID"]."'"));
			$idsale="";$notificationfoot="";$notificationhead="";$notificationpercent="";
			$price=$row["PRICE"];
			if($getSale!=null){	//Kiem tra cac san pham co giam gia hay ko
				$getpercentSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT PERCENTAGE_DISCOUNT FROM discountprogram WHERE DISCOUNT_PROD_ID= '".$getSale['DISCOUNT_PROG_ID']."' "));
				$price=$price - $price* $getpercentSale['PERCENTAGE_DISCOUNT'];
				$idsale=$getSale['DISCOUNT_PROG_ID'];
				//Hien BadGe thong bao % giam gia
				$notificationhead= '  <div class="percent-sale">-';
				$notificationfoot='%</div> ';
				$notificationpercent=$getpercentSale['PERCENTAGE_DISCOUNT']*100;
			}
			$output .= "<div class=\"col-md-4 col-sm-12 text-center product-content \">
                        <div class=\"product-about\">
							$notificationhead $notificationpercent $notificationfoot
                            <img src=\"images/product-items/".$row["IMAGE_URL"]."\" class=\"img-fluid img-top-sold\">
                            <div class=\"overlay\">
                            <a class=\"info\" href=\"index.php?quanly=detail&id=".$row["PRODUCT_ID"]."&sale=\">Chi Tiết</a>
                            </div>
                        </div>
                        <div class=\"product-infor\">
                            ".$row["PRODUCT_NAME"]."
                            <p style=\"margin-bottom: 1ex;\">
                            <b class=\"price\" style=\"color: red\">".$price." VNĐ</b>
                            </p>
                    	</div>	
			        </div>";
		}
	}
	else
	{
		$output = '<h3>KHÔNG TÌM THẤY SẢN PHẨM PHÙ HỢP</h3>';
	}
	echo $output;
}

?>