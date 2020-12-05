<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
//if(!isset($_SESSION['IS_LOGIN'])){
  // redirect('../login_register.php');
//}
if(isset($_SESSION['IS_LOGIN']))
{
$sql1 = "select * from tbl_cust where Username='".$_SESSION['IS_LOGIN']."'";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($res1);
$name=$row['Cust_name'];
$c_id=$row['Cust_id'];
$Username=$row['Username'];
}
$stall_res=mysqli_query($con,"select * from tbl_stall");
$stall_arr=array();
$scat_res=mysqli_query($con,"select * from tbl_subcat");
$scat_arr=array();
$cat_res=mysqli_query($con,"select * from tbl_cat order by Cat_name asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}
while ($row1=mysqli_fetch_assoc($scat_res)) {
    $scat_arr[]=$row1;
}
while ($row2=mysqli_fetch_assoc($stall_res)) {
    $stall_arr[]=$row2;
}
//$obj=new add_to_cart();
//$totalProduct=$obj->totalProduct();

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Food Court</title> <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- header start -->

             	<div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="shop.php">Home</a></li>
                                        <li><a href="about.php">about</a></li>
                                        <!-- <li><a href="contact.html">contact us</a></li> -->
                                        <li><a href="myorder.php">My Orders</a></li>
                                        <li><a href="my-account.php">My Account</a></li>
                                        <li><a href="cart1.php">My Cart</a></li>
                                        <li style="float: right">                           
                                         <a class="dropdown-item" href="logout.php">
                                            <i class="mdi mdi-logout text-primary"></i>
                                         Logout
                                         </a>
                                     	</li>
                                <!-- <li class="top-hover">
                                <a href="#">Stalls<i class="ion-chevron-down"></i></a>
                                <ul class="dropdown">
                                <?php  foreach ($stall_arr as $list){  ?>
                                <li><a href="stall.php?id=<?php echo $list['Stall_id']?>"><?php echo $list['Stall_name']?></a></li>
                                <?php }?>
                                </ul>               
                                </li> -->
                                        
                                

                            <div class="account-curr-lang-wrap f-right">
                                <ul>
                                    
                                    
                                    <li class="top-hover" style="margin-left: -50px"><a href="#">Stalls  <i class="ion-chevron-down"></i></a>
                                        <ul>
                                            <?php  foreach ($stall_arr as $list){  ?>
                                            <li><a href="stall.php?id=<?php echo $list['Stall_id']?>"><?php echo $list['Stall_name']?></a></li>
                                             <?php }?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                                 </nav>       
                                </div>
                                 
                                
                            </div>
                        </div>
                    </div>
                </div>
            
<!--            <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><h5><a href="">Stalls</a></h5></li>
                        <li class="active">Shop Grid Style </li> 
                        <?php
                                        foreach ($stall_arr as $list){
                                            ?>
                                           <li><h5><a href="stall.php?id=<?php echo $list['Stall_id']?>"><?php echo $list['Stall_name']?></a></h5></li>
                                            <?php
                                          }
                                        ?>
                    </ul>
                </div>
            </div>
        </div> -->
            

            

            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="shop">Home</a></li>
										<li><a href="about-us">About Us</a></li>
										<li><a href="contact-us">Contact Us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->

        </header>
                <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>