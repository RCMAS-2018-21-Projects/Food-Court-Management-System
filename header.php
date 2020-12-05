<?php
//session_start();

// session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
//if(!isset($_SESSION['IS_LOGIN'])){
  // redirect('../login_register.php');
//}
if(isset($_SESSION['Cust_id']))
{
$sql1 = "select * from tbl_cust where username='".$_SESSION['Cust_id']."'";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($res1);
$name=$row['Cust_name'];
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
        <header class="header-area">
<!--             <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-4 col-12 col-sm-4">
                        </div>
						<div class="col-lg-2 col-md-4 col-12 col-sm-4">
							<?php
								if(isset($_SESSION['FOOD_USER_NAME'])){
								?>
							<div id="wallet_top_box">
								<a href="<?php echo FRONT_SITE_PATH?>wallet" style="color:#fff;">
									Wallet Amt:- <?php echo $getWalletAmt?>
								</a>
								
							</div>
								<?php  } ?>
						</div>

                    </div>
                </div>
            </div> -->
                        <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="shop.php">Home</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <!-- <li><a href="contact.html">contact us</a></li> -->

                                        <li style="float: right"> 

                                   		<a href="login_register.php" >                                        
										Register/Sign in					
                                        </a></li>	
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
            <!--<div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="<?php echo FRONT_SITE_PATH?>">
                                    <img alt="" src="<?php echo FRONT_SITE_PATH?>assets/img/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-middle-right f-right">

                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                                <!--<div class="header-cart">
                                    <a href="#">
                                        <div class="header-icon-style">
                                            <i class="icon-handbag icons"></i>
                                            <span class="count-style" id="totalCartDish"><?php echo $totalCartDish?></span>
                                        </div>
                                        <div class="cart-text">
                                            <span class="digit">My Cart</span>
                                            <span class="cart-digit-bold" id="totalPrice">
											<?php 
											if($totalPrice!=0){
												echo $totalPrice.' Rs';
											}
											?></span>
                                        </div>
                                    </a>
									<?php if($totalPrice!=0){?>
									<div class="shopping-cart-content">
                                        <ul id="cart_ul">
											<?php foreach($cartArr as $key=>$list){ ?>
												<li class="single-shopping-cart" id="attr_<?php echo $key?>">
													<div class="shopping-cart-img">
														<a href="javascript:void(0)"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
													</div>
													<div class="shopping-cart-title">
														<h4><a href="javascript:void(0)">
														<?php echo $list['dish']?>
														</a></h4>
														<h6>Qty: <?php echo $list['qty']?></h6>
														<span><?php echo 
														$list['qty']*$list['price'];?> Rs</span>
													</div>
													<div class="shopping-cart-delete">
														<a href="javascript:void(0)" onclick="delete_cart('<?php echo $key?>')"><i class="ion ion-close"></i></a>
													</div>
												</li>
											<?php } ?>
                                        </ul>
                                        <div class="shopping-cart-total">
                                            <h4>Total : <span class="shop-total" id="shopTotal">
											<?php echo $totalPrice?> Rs
											</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn">
                                            <a href="cart">view cart</a>
                                            <a href="<?php echo FRONT_SITE_PATH?>checkout">checkout</a>
                                        </div>
                                    </div>-->
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <!--<div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>shop">Shop</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>about-us">about</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>contact-us">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
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