
<header id="header"> 
    <div class="row">
        <div class="col-md-1 col-sm-0"></div>

        <div class="Search col-md-6 col-sm-5" >
            <form action="index.php?manage=search" method="post" class="row g-3">
                <div class="col-1"  >
                    <a href="index.php"><img src="images/logo3.png" alt="Trang chủ"></a>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="search_product" placeholder="Nhập tên sách">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-secondary" name="search_submit" >Tìm kiếm</button>
                </div>

            </form>
        </div>

        <div class="Account col-md-5 col-sm-5" >
            <form class="row g-2">
                <div class="col-auto">
                    <button class="btn btn-outline-success login"  ><a   style="text-decoration: none;color:green; font-weight:bold;"href=
                    '<?php
                        if (isset($_SESSION['login']) ) {
                             echo "index.php?manage=user";
                            }
                        else echo "interfaces/login.php";
                    ?>'
                >
                <?php 
                    if (isset($_SESSION['login']) ) {
                        echo $_SESSION['customer_name']; 
                    }
                    else echo "Đăng Nhập";

                ?>	</a></button>
                </div>

                <div class="col-auto">
                    <button class="btn btn-outline-danger register" ><a class="register" style="text-decoration: none;color:red;font-weight:bold;" href=
                    '<?php
                        if (isset($_SESSION['login']) ) {
                            if($_SESSION['login']) 
                            echo "interfaces/logout.php";
                            else echo "interfaces/register.php";
                            }
                        else echo "interfaces/register.php";
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
                <div class="col-auto" onclick="showCartContainer()">
			        <a class="icon-button"><i class="fa fa-shopping-cart" style="font-size:36px; color:black"></i></a>
		        </div> 
            </form>
        </div>

    </div>
		
		
</header>