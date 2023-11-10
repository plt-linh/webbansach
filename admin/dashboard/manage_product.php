<div class="list-product">
    <div class="row m-md-3">
        <div class="title_left mt-3 mx-2">
            <p>Quản lý sản phẩm</p>
        </div>
        <div class="p_panel">
            <form class="m-md-3" >
                <div class="row g-2 mb-2">
                    <div class="col-auto">
                        <label class="form-label">TÊN SÁCH:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="email" placeholder="Nhập tên sách" name="name">
                    </div>
                    <div class="col-auto">
                        <label class="form-label">GIÁ TỪ:</label>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" id="minprice" placeholder="0" name="minprice">
                    </div>
                    <div class="col-auto">
                        <label class="form-label">ĐẾN:</label>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" id="maxprice" placeholder="0" name="maxprice">
                    </div>
                    <div class="col-auto">
                        <label class="form-label">THỂ LOẠI:</label>
                    </div>
                    <div class="col-1">
                        <select class="form-select"name="category" id="category">
                            <option value="-">---</option>
                            <?php 
                                $connect = mysqli_connect("localhost", "root", "", "website");
                                $get_Category= mysqli_query($connect,"SELECT DISTINCT CATEGORY from products");
                                while($row_Category = mysqli_fetch_array($get_Category)) { ?>
                                <option value="<?php echo $row_Category['CATEGORY']?>"> <?php echo $row_Category['CATEGORY']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="form-label">NHÀ CUNG CẤP:</label>
                    </div>
                    <div class="col-1">
                        <select class="form-select"name="supplier" id="supplier">
                            <option value="-">---</option>
                            <?php 
                                $connect = mysqli_connect("localhost", "root", "", "website");
                                $get_Supplier= mysqli_query($connect,"SELECT DISTINCT SUPPLIER from products");
                                while($row_Supplier = mysqli_fetch_array($get_Supplier)) { ?>
                                <option value="<?php echo $row_Supplier['SUPPLIER']?>"> <?php echo $row_Supplier['SUPPLIER']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-info">Tìm</button>
                    </div>
                    <div class="col-auto">
                        <a href="dashboard/add_product.php" class="btn btn-success">Thêm mới</a>
                    </div>
                </div>               
            </form>
        </div>
        
        <?php
            $querry1 = "SELECT * FROM products";
            $products = mysqli_query($connect,$querry1);
        ?>
        <div class="table-striped">
            <table class="table">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Tên sách</th>
                        <th scope="col">Tác giả</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Nhà cung cấp</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="search_content text-center">
                    <?php
                        foreach ($products as $products): 
                    ?>
                    <tr>
                        <td><?php echo $products['PRODUCT_ID'] ?></td>
                        <td><?php echo $products['PRODUCT_NAME'] ?></td>
                        <td><?php echo $products['AUTHOR'] ?></td>
                        <td><?php echo $products['CATEGORY'] ?></td>
                        <td><?php echo $products['SUPPLIER'] ?></td>
                        <td><?php echo $products['QUANTITY'] ?></td>
                        <td><?php echo $products['PRICE'] ?></td>
                        <td style="width:30%; text-align:left"><?php echo $products['DESCRIPTION'] ?></td>
                        <td style="width:10%"><?php echo $products['IMAGE_URL'] ?></td>
                        <td>
                            <a href="dashboard/edit_product.php?this_id=<?php echo $products['PRODUCT_ID'] ?>" class="btn btn-primary" style="font-size:12px">Sửa</a>
                            <a href="dashboard/delete_product.php?this_id=<?php echo $products['PRODUCT_ID'] ?>" class="btn btn-danger" style="font-size:12px">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<style>
    .title_left {
        font-size: 18pt;
    }
    .list-product {
	font-family: 'Arial';
    color: rgb(143, 143, 163);
    background-color: aliceblue;
    width: 100%;
    height: 100%;
    }
    .container .row {
        width: 100%;
        height: 100%;
    }
    .p-panel {
        font-size: 14pt;
    }
    .table {
        font-size: 12px;
        color: grey;
    }
</style>