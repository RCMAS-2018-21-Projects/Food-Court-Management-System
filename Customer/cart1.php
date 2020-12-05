<?php  
ob_start();
include ("header.php");

         if(isset($_GET['delete']))
         {
            $ccd=$_GET['delete'];
        $s="delete from tbl_cart where Cart_id='$ccd'";
        $res=mysqli_query($con,$s); 
      }
      
      if(isset($_POST['update']) && isset($_POST['Quantity']) && isset($_POST['Cart_id']))
      {
        $iid=$_POST['Cart_id'];
        $Quantity=$_POST['Quantity'];
        $s="update tbl_cart set qty='$Quantity' where Cart_id='$iid'";
        //echo $s;
       $r= mysqli_query($con,$s);
        if(!$r)
        {
          echo "error".mysqli_error($con);
        }
      
      }
?>
        
		<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="POST">
                           <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                        
                                        <th>Product</th>
                                         
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>total</th>
                                        <th>Stall</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                  <?php
                 
                 $S="select tbl_stall.*,tbl_cart.*,tbl_item.* from tbl_stall,tbl_cart,tbl_item where tbl_cart.Item_id=tbl_item.Item_id and tbl_cart.Cust_id='$c_id' and tbl_stall.Stall_id=tbl_Item.Stall_id";
                    $rez=mysqli_query($con,$S);
                    if(!$rez)
                    {
                     echo "error".mysqli_error($con);
                    }
                    $c=0;$i=0;$tot=0;
                    if(mysqli_num_rows($rez)>0){
                    while($e=mysqli_fetch_assoc($rez)){
     
                     $Cart_id=$e['Cart_id'];
                     $Quantity=$e['qty']; 
                     $i+=$Quantity;
                     $price=$e['Item_price']; 
                     $subtot=$Quantity*$price;
                     $tot+=$subtot;

                ?>
                                        <tr>

                                            <td class="product-thumbnail">
                                                <?php echo '<img src="admin/upload/'.$e['Item_image'].'" alt="image" class="img-fluid" width="100px" height="100px">'?>
                                            </td>
                                            <td class="product-name"><?php echo $e['Item_name']?></td>
                                            

                                            <td class="product-quantity">
                                                
                                                    
                                                    <input type="text" name="Cart_id" value="<?php  echo $Cart_id;  ?>" hidden>
                                                    <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="Quantity" value="<?php echo $e['qty']?>"></div>
                                                    <!-- <button type="submit" name="update" class="btn btn-outline-primary">Update</button> -->
                                                
                                            </td>
                                            

                                            <td class="product-price-cart"><span class="amount"><?php echo $e['Item_price']?></span></td>
                                            <td class="product-subtotal"><?php echo $subtot." Rs";?></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo $e['Stall_name']?></span></td>
                                            <td class="product-quantity">
                                           <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                         </td>
                                            <td class="product-remove">
                                                <!-- <a href="#"><i class="fa fa-pencil"></i></a> -->
                                                <a href="?delete=<?php echo $Cart_id; ?>"><i class="fa fa-times"></i></a>  
                                           </td>
                                           </form>

                                        </tr>

                                        <?php  } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="shop.php">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <!-- <button>Proceed</button> -->
                                            <!-- <a href="#">Clear Shopping Cart</a> -->
                                        </div>
                                        <div class="cart-shiping-update">
                                             <a href="pay_counter.php">Pay at Counter</a>
                                        </div>
                                        <div class="cart-shiping-update">
                                              <a href="pay.php">Pay Online</a>
                                        </div>


                                      </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    
                
              </div>
            </div>

            </div>
          </div>
        
        
        <?php include("footer.php");
        ?>
		<!-- <div class="footer-area black-bg-2 pt-70">
            <div class="footer-bottom-area border-top-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-7">
                            <div class="copyright">
                                <p>Copyright © <a href="#">Billy.</a> . All Right Reserved.</p>
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
            </div>
        </div> -->
        
		<!-- all js here -->
              <!-- Modal 1-->
     <!-- //Modal 1-->
      <!--js working-->
      <script src='olaka/jumbo/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- cart-js -->  
      <script src="olaka/jumbo/minicart.js"></script>
      <!-- <script>
         toys.render();
         
         toys.cart.on('toys_checkout', function (evt) {
          var items, len, i;
         
          if (this.subtotal() > 0) {
            items = this.items();
         
            for (i = 0, len = items.length; i < len; i++) {}
          }
         });
      </script> -->
      <!--// cart-js -->
      <!--quantity-->
      <!-- <script>
         $('.value-plus').on('click', function () {
          var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) + 1;
          divUpd.text(newVal);
         });
         
         $('.value-minus').on('click', function () {
          var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) - 1;
          if (newVal >= 1) divUpd.text(newVal);
         });
      </script> -->
      <!--quantity-->
      <!--closed-->
     <!--  <script>
         $(document).ready(function (c) {
          $('.close1').on('click', function (c) {
            $('.rem1').fadeOut('slow', function (c) {
              $('.rem1').remove();
            });
          });
         });
      </script> -->
      <!-- <script>
         $(document).ready(function (c) {
          $('.close2').on('click', function (c) {
            $('.rem2').fadeOut('slow', function (c) {
              $('.rem2').remove();
            });
          });
         });
      </script> -->
      <!-- <script>
         $(document).ready(function (c) {
          $('.close3').on('click', function (c) {
            $('.rem3').fadeOut('slow', function (c) {
              $('.rem3').remove();
            });
          });
         });
      </script> -->
      <!--//closed-->
      <!-- start-smoth-scrolling -->
      <script src="olaka/jumbo/move-top.js"></script>
      <script src="olaka/jumbo/easing.js"></script>
      <!-- <script>
         jQuery(document).ready(function ($) {
          $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({
              scrollTop: $(this.hash).offset().top
            }, 900);
          });
         });
      </script> -->
      <!-- start-smoth-scrolling -->
      <!-- here stars scrolling icon -->
      <!-- <script>
         $(document).ready(function () {
         
          var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
          };
          $().UItoTop({
            easingType: 'easeOutQuart'
          });
         
         });
      </script> -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
