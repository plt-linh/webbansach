<header id="header"> 
    <div class="row">
        <div class="col-md-1 col-sm-0"></div>

        <div class="Logo-Brand col-md-1 col-sm-2" >
            <img src="images/logo.png " style="width: 100%; ">
        </div>

        <div class="Search col-md-7 col-sm-5" >
            <form class="row g-2">
                <div class="col-9">
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên sách">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
                </div>
            </form>
        </div>

        <div class="Account col-md-3 col-sm-5" >
            <button class="btn btn-outline-secondary login"   ><a   style="text-decoration: none;font-weight:bold;"href=
                '<?php
                        if (isset($_SESSION['login']) ) {
                            if($_SESSION['login']) echo "index.php?quanly=user";
                            else echo "giaodien/login.php";
                            }
                        else echo "giaodien/login.php";
                ?>'
            >
            <?php 
                if (isset($_SESSION['login']) ) {
                    if($_SESSION['login']) echo '<i class="fas fa-user-alt"></i> '.$_SESSION['customer_name'].""; 
                    
                    else echo "Đăng Nhập";
                }
                else echo "Đăng Nhập";

            ?>	</a></button>
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
                
    </div>
		
		
</header>