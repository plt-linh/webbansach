<?php
session_start();
function UpdateCustomer() { 
	if(!empty($_POST)){
	   $fullname =$_POST['fullname'];
	   $password =$_POST['psw'];
	   $password=md5($password);
	   $phone =$_POST['phone'];
	   $address =$_POST['address'];
	   include("../db/MySQLConnect.php");
	   $name=$_SESSION['customer_name'];

   //thuc hien truy van du lieu - chen u lieu vao database 2 bang taikhoan va khachhang
   $query="UPDATE customers SET CUSTOMER_NAME='$fullname',PHONE='$phone',ADDRESS='$address' WHERE CUSTOMER_NAME='$name'";
	$query1=" UPDATE `accounts` SET FULL_NAME='$fullname',PASSWORD='$password' WHERE FULL_NAME='$name'";
		echo $query1;
		echo $query;
	$result=mysqli_query($connect,$query);	
	$result1=mysqli_query($connect,$query1);
   	header("Location:../index.php?manage=user");
	   $_SESSION['customer_name']=$fullname;
	$connect->close();        
   }
}
UpdateCustomer();

?>
