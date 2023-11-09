<header id="header"> 
    <div class="row">
        <div class="col-md-1 col-sm-0"></div>

        <div class="Search col-md-7 col-sm-5" >
            <form class="row g-3">
                <div class="col-1"  >
                    <img src="images/logo3.png" alt="Trang chủ">
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên sách">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-secondary" id="submitSearch" onclick="validatePrice()">Tìm kiếm</button>
                </div>
            </form>
        </div>

        <div class="Account col-md-4 col-sm-5" >
            <form class="row g-2">
                <div class="col-auto">
                    <button class="btn btn-outline-secondary login"   ><a   style="text-decoration: none;font-weight:bold;"href=
                    '<?php
                            if (isset($_SESSION['login']) ) {
                                if($_SESSION['login']) echo "index.php?quanly=user";
                                else echo "interfaces/login.php";
                                }
                            else echo "interfaces/login.php";
                    ?>'
                >
                <?php 
                    if (isset($_SESSION['login']) ) {
                        if($_SESSION['login']) echo '<i class="fas fa-user-alt"></i> '.$_SESSION['customer_name'].""; 
                        
                        else echo "Đăng Nhập";
                    }
                    else echo "Đăng Nhập";

                ?>	</a></button>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-secondary register" ><a class="register" style="text-decoration: none;font-weight:bold;" href=
                    '<?php
                        if (isset($_SESSION['login']) ) {
                            if($_SESSION['login']) echo "giaodien/logout.php";
                            else echo "giaodien/register.php";
                            }
                        else echo "giaodien/register.php";
                    ?>'
                >
                    <?php
                        if (isset($_SESSION['login']) ) {
                            if($_SESSION['login']) echo "Đăng Xuất"; 
                            
                            else echo "Đăng Ký";
                        }
                        else echo "Đăng Ký";

                    ?>
                </a> </button>
                </div>
            </form>
            

            
        
        </div>
                
    </div>
		
		
</header>