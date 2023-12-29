<style>
    

    .lightbox {
        position: relative;
    }

    .lightbox img {
        width: 100%;
        cursor: pointer;
    }

    .lightbox .close-btn {
        color: #fff;
        font-size: 24px;
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
    }
    .detail {
        width: 100%;
    }
    .container-mid {
        background-color: white;
        margin-right:8px
    }
    .container-right {
        background-color: white;

    }
    .container-left {
        background-color: white;
        margin-right: 8px
    }

    .container-comment {
        background-color: white;
    }
    .lightbox-img {
        width: 100px; /* Kích thước ban đầu của ảnh thumbnail */
        height: auto;
        cursor: pointer;
    }

    .lightbox-img:hover {
        border: 2px solid #fff; /* Hiển thị đường viền khi hover */
    }
</style>

<?php
    include "db/MySQLConnect.php";
    //lấy chi tiết
    $product_id = $_GET['product_id'];
    $getdetail = "SELECT * FROM products WHERE PRODUCT_ID = " . $product_id;
    $resultDetail = mysqli_query($connect, $getdetail);
    $row_product_detail = mysqli_fetch_assoc($resultDetail);

    //lấy bình luận 
    $getname = "SELECT PRODUCT_NAME FROM products WHERE PRODUCT_ID='$product_id'";
    $querry1=mysqli_query($connect, $getname);
    $product_name = mysqli_fetch_array($querry1)['PRODUCT_NAME'];
    $getComment = "SELECT FULL_NAME, CONTENT, IMAGE FROM comment INNER JOIN products INNER JOIN accounts
    ON comment.PRODUCT_ID=products.PRODUCT_ID AND comment.USER=accounts.FULL_NAME
    WHERE PRODUCT_NAME LIKE '%$product_name%'
    ORDER BY COMMENT_ID DESC LIMIT 0,5";

    $resultComment = mysqli_query($connect,$getComment);



?>
<div class="container-fluid">
    <div class="container-fluid index row g-3">
        <div class="col-md-1"></div>
        <div class="container-left lightbox col-md-4">
            <a href="interfaces/loadImage.php?filename=<?php echo $row_product_detail['IMAGE_URL']?>">
            <img class="py-4"src="images/products/<?php echo $row_product_detail['IMAGE_URL']?>" />
        </a>          
        </div>

        <div class="container-mid col-md-4 py-2 ">
            <h4 ><?php echo $row_product_detail['PRODUCT_NAME']?></h4>
            <p>Tác giả: <?php echo $row_product_detail['AUTHOR']?></p>
            <h3 style="font-weight:bold "><?php echo number_format($row_product_detail['PRICE'], 0, '', ' ') . " ₫";?></h3>
            <h5>Thông tin chi tiết:</h5>
            <div class="table-striped">
                <table class="table">
                    <tr>
                        <th>Hàng chính hãng</th>
                        <td>Có</td>
                    </tr>
                    <tr>
                        <th>Thể loại</th>
                        <td><?php echo $row_product_detail['CATEGORY'] ?></td>
                    </tr>
                    <tr>
                        <th>Công ty phát hành</th>
                        <td><?php echo  $row_product_detail['SUPPLIER']?></td>
                    </tr>
                    <tr>
                        <th>Số lượng còn</th>
                        <td><?php   $stock = $row_product_detail['QUANTITY'];
                                    if ($stock > 0) {echo $stock . " sản phẩm";}
                                    else {"Hết hàng";}
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Nhà xuất bản</th>
                        <td> </td>
                    </tr>
                    <tr>
                        <th>Ngày xuất bản</th>
                        <td> </td>
                    </tr>
                </table>
            </div>
            
            <h5 class = "py-2">Mô tả sản phẩm:</h5>
            <p><?php echo $row_product_detail['DESCRIPTION']?></p>
        </div>

        <div class="container-right col-2 py-3 px-3">
            <form id="detailForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method = "POST">
            <input type="hidden" name="cart" value="add" />
            <h5>Số lượng mua</h5>
            <div class="buttons_added py-1 px-3 row g-3">
                <input style="cursor: pointer; margin-right:3px" class="minus is-form col-2" type="button" value="-" onclick="adjustQuantity(this)">
                <input aria-label="quantity" id="txQuantity_detail" class="input-qty col-6" min="1" name="quantity" type="number" value=1>
                <input style="cursor: pointer; margin-left:3px" class="plus is-form col-2" type="button" value="+" onclick="adjustQuantity(this)">
            </div>
            <div class = "btn-detail row py-2 px-3" >
                <button class="btn btn-danger">Mua ngay</button>
                <button id="btAddCart" value="add" onclick="checkQuantity()" style="margin-top: 5px"type="button" class="btn btn-outline-primary">Thêm vào giỏ hàng</button>
            </div>
            </form>               
            
        </div>

    </div>
    <div class="container-fluid comment py-2 row g-3">
        <div class="col-md-1"></div>
        <div class="container-comment col-md-10 py-3 px-3">
            <h5 style="margin-bottom:10px">Khách hàng đánh giá</h5>
            <?php
                if(mysqli_num_rows($resultComment) > 0) {
                    while ($row= mysqli_fetch_array($resultComment)) {
                ?>
            <div class="card container-comment">           
                <div class="card-header">
                    <h6 style="font-weight: bold"><?php echo $row['FULL_NAME']?></h6>

                    <!-- <a href="interfaces/loadImage.php?image=<?php echo $row['IMAGE']; ?>"> -->
                    <a href="images/comments/<?php echo $row['IMAGE']; ?>">
                    <img src="images/comments/<?php echo $row['IMAGE']; ?>" class="lightbox-img" />
                    </a>
                    
                    <!-- sửa lỗi path traversal -->
                    <!-- <a data-fancybox="gallery" href="images/comments/<?php echo $row['IMAGE']; ?>">
                        <img src="images/comments/<?php echo $row['IMAGE']; ?>" class="lightbox-img" />
                    </a> -->

                    <p style="margin-top: 10px;"><?php echo $row['CONTENT'] ?></p>
                </div>

            </div>
            <?php
                }
            } else {
                ?>
                <div class = "text-center">
                    <p style="color:grey">Chưa có đánh giá nào</p>
                </div>
                <?php } ?>
            <form style="margin-top: 8px" class="text-center form row g-2" action="interfaces/add_comment.php?product_id=<?php echo $product_id ?>" method="POST" enctype="multipart/form-data">
                <input class="form-control"type="text" name="content" placeholder="Nhập đánh giá">
                <input type="file" name="imgc">
                <div style="text-align:right col-md-2">
                    <button class="btn btn-success" type="submit" name="btn">Gửi</button>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<script>
	function checkQuantity(){
        var quantityInput = document.getElementById("txQuantity_detail").value;

        var quantity = parseInt(quantityInput);
        if (isNaN(quantity) || quantity <= 0) {
            alert("Số lượng sản phẩm không hợp lệ");
            return;
        }

        if (quantity > <?php echo $stock ?>) {
            alert("Chỉ còn <?php echo $stock ?> sản phẩm");
            return;
        }

        detailForm.submit();
	}
	if(document.getElementById("txQuantity_detail").value==0)
		document.getElementById("btAddCart").disabled="disabled";
	else
		document.getElementById("btAddCart").disabled="";

    
</script>

<!-- <script>
    function openLightbox(img) {
        var lightboxOverlay = document.createElement("div");
        lightboxOverlay.className = "lightbox-overlay";
        
        var lightboxContent = document.createElement("div");
        lightboxContent.className = "lightbox-content";
        
        var largeImg = document.createElement("img");
        largeImg.src = img.src;
        
        var closeBtn = document.createElement("div");
        closeBtn.className = "close-btn";
        closeBtn.innerHTML = "x";
        closeBtn.onclick = function() {
            document.body.removeChild(lightboxOverlay);
        };
        
        lightboxContent.appendChild(largeImg);
        lightboxContent.appendChild(closeBtn);
        lightboxOverlay.appendChild(lightboxContent);
        
        document.body.appendChild(lightboxOverlay);
    }
</script> -->
