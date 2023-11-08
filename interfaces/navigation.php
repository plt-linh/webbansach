<!-- <?php
    $index=""; $product="";
    if(!isset($_GET['quanly'])) $index="active";
    else if($_GET['quanly']=='product') $product="active";
      $getCategory=mysqli_query($conn,"SELECT DISTINCT CATEGORY FROM products;");
?> -->
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">TRANG CHỦ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">SẢN PHẨM</a>
  </li>
  
</ul>