
<?php
//session_start();
include('database.inc.php');
include('header.php');
$mg='';$name='';$rate='';

if(isset($_SESSION['IS_LOGIN']))
{
  $q=$_SESSION['IS_LOGIN'];


}
 else{
header("location:login_register.php");

   }


$buy='s';
if(isset($_GET['id'])&&isset($_GET['qty'])){
  $id=$_GET['id'];
  $qty=$_GET['qty'];
  $st="select *from tbl_item where Item_id='$id'";
  $tr=mysqli_query($con,$st);
  if(!$tr)
  {
    echo "error".mysqli_error($con);
    die();
  }

          $er=mysqli_fetch_assoc($tr);
          $name=$er['Item_name']; 
          $rate=$er['Item_price']; 
       

}


   $msg='';


 if(isset($_POST['p-bt'])&&isset($_POST['tot']))
 {
    $t=$_POST['tot'];
 
    $type=$_POST['type'];
  $ty=$_POST['ty'];
    $number=$_POST['number'];
    $name=$_POST['name'];
    $n=$number;
    $date=$_POST['date'];
    $cvv=$_POST['cvv'];
     $len=strlen($n); 
     $length=$len-3;
     $d=0;
  

if($length==16){
   function validateCCExpDate($str)

  {
    
     return preg_match("/(0[1-9]|1[0-2])\/20[0-9]{2}$/", $str);
  }
   $ExpDate =$_POST['date'];

   validateCCExpDate($ExpDate) ? $ms="true" : $ms="false";
   if($ms=='false')
        {
            $e1="invalid Date";
        }
   if($ms=='true')
   {
    $arr=explode("/",$ExpDate);
      $m=$arr[0];
      $y=$arr[1];

    $year = date("Y");
    $month = date("m");
    if($m<=12 && $y>=$year)
    {
        $d=1;
    }
   else if($y==$year && $m<=$month)
   {
     $d=1;
   }
   else
   {
    $a="invalid Date";
   }
    
   }
   if($d==1){
    $da=date("Y/m/d");
    $s="select *from tbl_cust where Username='$q'";
    $r=mysqli_query($con,$s);
    $row=mysqli_fetch_assoc($r);
    $cust_id=$row['Cust_id'];
    $s1="insert into tbl_order_master(Cust_id,Order_date,tot_amt,Order_status)values('$cust_id','$da','$t','Null')";
    $r1=mysqli_query($con,$s1);


    $s3="select *from tbl_order_master where Cust_id='$cust_id' AND Order_status='NULL'";
    $r3=mysqli_query($con,$s3);
    if(!$r3)
    {
      echo "error".mysqli_error($con);
      die();
    }
   
      
    $row3=mysqli_fetch_assoc($r3);
    $order_id=$row3['Morder_id'];
    


     $sql="insert into tbl_order_child(Morder_id,item_id,Quantity)values('$order_id','$id','$qty')";
      $op=mysqli_query($con,$sql);
      if(!$op)
      {
        Echo "error".mysqli_error($con);
        die();
      }

    

   }




   $exp="select *from tbl_cardc where Card_no='$number'";
    $rc=mysqli_query($con,$exp);
    $bn=mysqli_fetch_assoc($rc);
    if(mysqli_num_rows($rc)<=0)
  
    {

    $s5="insert into tbl_cardc(Card_no,Cust_id,Card_name,Expiry,Card_type)values('$number','$cust_id','$name','$date','$ty')";
   $vb=mysqli_query($con,$s5);
  }
    if(!$vb)
   {
   
      mysqli_error($con);
      die();
     }
    



  $time=date("h:i:sa");
    $s4="insert into tbl_pay(Cust_id,Morder_id,Card_no,P_type,P_time,P_status)values('$cust_id','$order_id','$number','$type','$time','successfull')";
    $po=mysqli_query($con,$s4);
          if(!$po)
      {
        Echo "error".mysqli_error($con);
        die();
      }
     else{
       header("location:success.php?a=$order_id");
     }


    

}
 

 else{
        $g="invalid number";
        
 }
}






 if(isset($_POST['card']))
 {
   $gna=$_POST['gna'];
   $gno=$_POST['gno'];
   $ty=$_POST['ty'];
   $gda=$_POST['gda'];
   if($ty==0)
   {
    $t=0;
   }
   else
   {
    $t=1;
   }


}

   ?>

   
<!-- <!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Billy - Food & Drink eCommerce Bootstrap4 Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        header start 
        <header class="header-area">
            <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                            <div class="welcome-area">
                                <p>Default welcome msg! </p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12 col-sm-8">
                            <div class="account-curr-lang-wrap f-right">
                                <ul>
                                    
                                    
                                    <li class="top-hover"><a href="#">Setting  <i class="ion-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="wishlist.html">Wishlist  </a></li>
                                            <li><a href="login-register.html">Login</a></li>
                                            <li><a href="login-register.html">Register</a></li>
                                            <li><a href="my-account.html">my account</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="index.html">
                                    <img alt="" src="assets/img/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-middle-right f-right">
                                <div class="header-login">
                                    <a href="login-register.html">
                                        <div class="header-icon-style">
                                            <i class="icon-user icons"></i>
                                        </div>
                                        <div class="login-text-content">
                                            <p>Register <br> or <span>Sign in</span></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                                <div class="header-cart">
                                    <a href="#">
                                        <div class="header-icon-style">
                                            <i class="icon-handbag icons"></i>
                                            <span class="count-style">02</span>
                                        </div>
                                        <div class="cart-text">
                                            <span class="digit">My Cart</span>
                                            <span class="cart-digit-bold">$209.00</span>
                                        </div>
                                    </a>
                                    <div class="shopping-cart-content">
                                        <ul>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="#">Phantom Remote </a></h4>
                                                    <h6>Qty: 02</h6>
                                                    <span>$260.00</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="ion ion-close"></i></a>
                                                </div>
                                            </li>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="#">Phantom Remote</a></h4>
                                                    <h6>Qty: 02</h6>
                                                    <span>$260.00</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="ion ion-close"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="shopping-cart-total">
                                            <h4>Shipping : <span>$20.00</span></h4>
                                            <h4>Total : <span class="shop-total">$260.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn">
                                            <a href="cart-page.html">view cart</a>
                                            <a href="checkout.html">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <!--  <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about-us.html">about</a></li>
                                        <li><a href="contact.html">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- mobile-menu-area-start -->
			<!-- <div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="index.html">Home</a></li>
										<li><a href="index.html">Home</a></li>
										<li><a href="index.html">Home</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- mobile-menu-area-end -->
<!--         </header>
        
		<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"> Checkout </li>
                    </ul>
                </div>
            </div>
        </div> --> 
        <!-- checkout-area start -->
        <div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span></span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Ordered Items</a></h5>
                                    </div>
                                    <div id="payment-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <div class="row">
                                                
                                                <div class="col-lg-12">
                                                    <div class="checkout-login">
                                                        <div class="title-wrap">
                                                            <h4 class="cart-bottom-title section-bg-white">Details</h4>
                                                        </div>
                                                        <p>&nbsp;</p>
                                                        <form>
                                                        <div class="login-form">
                                                                <label>Name :</label>
                                                                <?php echo $name?>
                                                            </div>
                                                            <div class="login-form">
                                                                <label>Quantity :</label>
                                                                <?php echo $qty?>
                                                            </div>
                                                            <div class="login-form">
                                                                <label>Total Amount :</label>
                                                                <?PHP echo number_format($rate*$qty)." Rs";?>
                                                            </div>
                                                            <!-- <div class="login-form">
                                                                <label>Password *</label>
                                                                <input type="password" name="email">
                                                            </div> -->
                                                        </form>
                                                        <!--  <div class="checkout-login-btn">
                                                            <a href="#">Login</a>
															<a href="#" style="background-color: #e02c2b;color:#fff;">Register Now</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- <div class="panel panel-default">  -->
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span></span> <a>Card Details</a></h5>
                                    </div>
                                    <!-- <div id="payment-2" class="panel-collapse collapse "> -->
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6">
                                                <div class="ship-wrapper">
                                                    <div class="single-ship">
                                                        <input type="radio" name="ty" value="debit" checked="">
                                                        <label>Debit</label>
                                                    </div>
                                                    <div class="single-ship">
                                                        <input type="radio" name="ty" value="credit">
                                                        <label>Credit</label>
                                                    </div>
                                                </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Name on Card</label>
                                                            <input type="text" class="input" placeholder="Name on card" name='name' value="<?php if(isset($gna))echo $gna; ?>"  required>
                                                             
                                                             <label>Card Nmber</label>
                                                             <input type="text" name="number" data-mask="0000 0000 0000 0000"  class="input" placeholder="Card Number" value="<?php if(isset($gno))echo $gno; ?>" required><br>
                                                             <div style="color: red;font-size:14px;"><?php if(isset($g)){echo $g;}?></div>
                                                              <!-- <?php ?> -->
                                                             
                                                             <div class="cvv1">
                                                                        Expiry Date<input type="text"  class="input" data-mask="00/0000"  placeholder="00 / 0000" name='date' value="<?php if(isset($gda))echo $gda; ?>"  required>
                                                                         <div style="color: red;font-size:12px; "><?php if(isset($a)){ echo $a;}?>
                                                                         <?php if(isset($e1)){echo $e1;}?>
                                                             </div>
                                                             <div class="cvv1">  
                                                              CVV<input type="password" class="input" data-mask="000" placeholder="000" name='cvv' required>
                                                             </div>
                                                 <form method="POST">           
                                                 <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button class="p-bt" type="submit" name="p-bt">Proceed</button>
                                                    </div>
                                                </div>
                                                </form> 
                                                        </div>
                                                    </div>
                                                   <!--  <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Mobile</label>
                                                            <input type="email">
                                                        </div>
                                                    </div> -->
													<!-- <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Zip/Postal Code</label>
                                                            <input type="text">
                                                        </div> -->
                                                    </div>
                                                    <!-- div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Address</label>
                                                            <input type="text">
                                                        </div>
                                                    </div> -->
                                                    
                                                </div>
<!--                                                 <div class="ship-wrapper">
                                                    <div class="single-ship">
                                                        <input type="radio" name="address" value="address" checked="">
                                                        <label>Cash on Delivery(COD)</label>
                                                    </div>
                                                    <div class="single-ship">
                                                        <input type="radio" name="address" value="dadress">
                                                        <label>Ship to different address</label>
                                                    </div>
                                                </div> -->
<!--                                                 <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button type="submit">Pay</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                <!-- </div> --> 
                                
						   </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="checkout-progress">
                            <div class="shopping-cart-content-box">
<!-- 								<h4 class="checkout_title">Cart Details</h4>
								<ul>
									<li class="single-shopping-cart">
										<div class="shopping-cart-img">
											<a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
										</div>
										<div class="shopping-cart-title">
											<h4><a href="#">Phantom Remote </a></h4>
											<h6>Qty: 02</h6>
											<span>$260.00</span>
										</div>
										
									</li>
									<li class="single-shopping-cart">
										<div class="shopping-cart-img">
											<a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
										</div>
										<div class="shopping-cart-title">
											<h4><a href="#">Phantom Remote</a></h4>
											<h6>Qty: 02</h6>
											<span>$260.00</span>
										</div>
										
									</li>
								</ul>
								<div class="shopping-cart-total">
									<h4>Total : <span class="shop-total">$260.00</span></h4>
								</div>
								
							</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
        
        
		<div class="footer-area black-bg-2 pt-70">
            <div class="footer-bottom-area border-top-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-7">
                            <div class="copyright">
                                <!-- <p>Copyright © <a href="#">Billy.</a> . All Right Reserved.</p> -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5">
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                    <li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
        </div>
        </div>
        
		<!-- all js here -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    </body>
</html>
