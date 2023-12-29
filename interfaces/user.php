<?php

$name=$_SESSION['customer_name'];
	$query1="SELECT * FROM customers WHERE CUSTOMER_NAME='$name'";
	$result = mysqli_query($connect,$query1);
	$row_customer=mysqli_fetch_assoc($result);
	$id_customer=$row_customer['CUSTOMER_ID'];

    /*Các đơn hàng đã đặt*/
  $getHD="SELECT * FROM orders where CUSTOMER_ID='$id_customer'"	;
  $resultHD=mysqli_query($connect,$getHD);

?>

<div class="user-content row my-3 mx-3">
	<div class="side-menu col-md-3 sol-sm-12">
		<div class="username ">
			Tài khoản của <br> <h5  class="font" style="padding-left: 22%;"><?php echo $row_customer['CUSTOMER_NAME']  ?></h5>
		</div>
		<div class="submenu">
			<ul>
				<li class="subc font" onclick="">Thông tin chung</li>
				
				<li class="subc font" onclick="document.getElementById('donhang').style.display='block'">Đơn hàng của tôi</li>
			</ul>
		</div>
	</div>
	<div class="information col-md-9 sol-sm-12">
		<div class="information-user">
			<h5 class="font title-infor" >THÔNG TIN CỦA TÔI </h5>
			<p class="font"><span class="font title-infor" >Họ Và Tên:</span> <?php echo $row_customer['CUSTOMER_NAME']  ?></p>
			<p class="font"><span class="font title-infor" >Điện Thoại:</span> <?php echo $row_customer['PHONE']  ?></p>
			<p class="font"><span class="font title-infor" >Địa Chỉ:</span> <?php echo $row_customer['ADDRESS']  ?></p>
		</div>
		<br>
		<button type="button" class="btn btn-warning" onclick="document.getElementById('id01').style.display='block'">Cập Nhật Thông Tin Cá Nhân</button>
		
		<br>
		
	
	</div>

	<div class="container-fluid table-order  my-3 mx-3" >		
		<br>			
		<div class="table-responsive-md" id="donhang"  style="display: none; margin 0 5%">
		<p class="font"  style="font-weight: bold; font-size: large;">Các Đơn Hàng Đã Đặt:</p>
			<table  class="table table-hover  table-bordered" >
				<thead class="thead-dark">
				<tr>
					<th class="tr">Mã Đơn Hàng</th>
					<th class="tr">Ngày Đặt</th>
					<th class="tr">Tên Sản Phẩm</th>
					<th class="tr">Tổng Tiền</th>
					<!-- <th class="tr" style="width: 10%;">Trạng Thái Đơn Hàng</th>
					<th class="tr" >Thao Tác</th> -->
				</tr>
				</thead>
				
				<?php 
				$huy="";
				$getIDhuy="";$id_huy="";
				while($row_hoadon=mysqli_fetch_array($resultHD)){
					$MA_HD=$row_hoadon['ORDER_ID'];
					$NGAY_DAT=$row_hoadon['DATE'];
					$TIEN=$row_hoadon['TOTAL_PRICE'];
					// $TRANG_THAI="Chưa Xử Lý";
					// if($row_hoadon['STATUS']==0) $TRANG_THAI="Đang Xử Lý";
					// else if($row_hoadon['STATUS']==1) $TRANG_THAI="Đã Hoàn Thành";
					// if($row_hoadon['STATUS']==-1) {
					// 	$huy='<button  type="button" class="btn btn-danger">
					// 	<a style="color:#000" href="index.php?manage=user&delete_id_order=';
					// 	$getIDhuy='">									Huỷ</a></button>';
					// 	$id_huy=$MA_HD;
						// if(isset($_GET['delete_id_order'])   ){
						// 	$MA_HD_DELETE=$_GET['delete_id_order'];
						// 	$deleteHD="DELETE FROM `orders` WHERE ORDER_ID='$MA_HD_DELET'";
						// 	$deleteCTHD="DELETE FROM `order_detail` WHERE ORDER_ID='$MA_HD_DELET'";
						// 	mysqli_query($connect,$deleteHD);
						// 	mysqli_query($connect,$deleteCTHD);
						// }
					// }
				?>
				<tr>
					<td class="items id_order"><?php echo $MA_HD ?> </a></td>
					<td class="items"><?php echo $NGAY_DAT ?></td>
					<td class="items name-product">
						<?php
						$getDSSP = "SELECT p.PRODUCT_ID, p.PRODUCT_NAME, SUM(od.QUANTITY) AS TotalQuantity, p.PRICE FROM products AS p INNER JOIN order_detail AS od ON p.PRODUCT_ID = od.PRODUCT_ID WHERE od.ORDER_ID='$MA_HD' GROUP BY p.PRODUCT_ID ORDER BY SUM(od.QUANTITY)";
						$resultchitietTenSP = mysqli_query($connect, $getDSSP);
						while ($row_TEN_SP = mysqli_fetch_array($resultchitietTenSP)) {
							$TEN_SP = $row_TEN_SP['PRODUCT_NAME'];
							$ID_SP = $row_TEN_SP['PRODUCT_ID'];
							$SL = $row_TEN_SP['TotalQuantity'];
						?>
							<a class="name_product_content" href="index.php?manage=detail&product_id=<?php echo $ID_SP ?>">
								<?php echo "$TEN_SP ---- Số Lượng: $SL </br> "; ?>
							</a>
						<?php
						}
						?>
					</td>
					<td class="items"><?php echo number_format($TIEN) ?> VNĐ</td>
					<!-- <td class="items"><?php echo $TRANG_THAI ?></td>
					<td class="items">
						<?php echo "$huy$id_huy$getIDhuy" ?>
					</td> -->
				</tr>
				<?php
				}
				?>
			
			</table>
		</div>
	</div>

</div>
		<!-- <?php
				if(isset($_GET['id_order'] ) && !empty($_GET['id_order'])  ) {
					include("interfaces/information_oder.php");
				}
			?> -->

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="./interfaces/action_user.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="input-content">
				<label for="fullname"><b>Họ và Tên:</b></label>
				<input class="login-input" type="text" placeholder="VD:Nguyễn Văn A" name="fullname" id="uname" required>

				<label for="psw"><b>Mật Khẩu:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Mật Khẩu:" name="psw"  id="psw"required>

				<label for="phone"><b>Số Điện Thoại:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Số Điện Thoại:" name="phone"  id="psw"required>

				<!-- <label for="gender"><b>Giới Tính:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Giới Tính:" name="gender"  id="psw"required> -->

				<label for="address"><b>Địa Chỉ:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Địa Chỉ:" name="address"  id="psw"required>
				
    </div>
	<div class="group-button row">
		<div class="col-md-2 col-sm-0"></div>
      <button type="button" class="btn btn-outline-danger col-md-3" onclick="document.getElementById('id01').style.display='none'">Huỷ</button>
	  <div class="col-md-2 col-sm-0"></div>
	  <button type="submit" class="btn btn-success col-md-3"  >Cập Nhật</button>
	  <div class="col-md-2 col-sm-0"></div>
	</div>
  </form>
</div>

