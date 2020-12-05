<?php  
ob_start();
include ("header.php");
         if(isset($_GET['delete']))
         {
            $ccd=$_GET['delete'];
        $s="delete from tbl_cart where Cart_id='$ccd'";
        $res=mysqli_query($con,$s); 
      }
      
      if(isset($_POST['update']) && isset($_POST['quantity']) && isset($_POST['cart_id']))
      {
        $iid=$_POST['Cart_id'];
        $qty=$_POST['quantity'];
        $s="update tbl_cart set quantity='$qty' where cart_id='$iid'";
       $r= mysqli_query($con,$s);
        if(!$r)
        {
          echo "error".mysqli_error($con);
        }
      
      }
   
   
   
            ?>
            <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
               <div class="shop_inner_inf">
                  <div class="privacy about">
                     <h3>Chec<span>kout</span></h3>
                     <div class="checkout-right">
                        <h4>Your shopping cart contains: <span></span></h4>
                        <table class="timetable_sub">
                           <thead>
                              <tr>
                                 <th>SL No.</th>
                                 <th>Product</th>
                                 <th>Quantity</th>
                                 <th>Product Name</th>
                                 <th>Price</th>
                                 <th>total</th>
                                 <th>Remove</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                 
                 $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.Item_id=tbl_item.Item_id and tbl_cart.Cust_id='$c_id'";
                    $rez=mysqli_query($con,$S);
                    if(!$rez)
                    {
                     echo "error".mysqli_error($con);
                    }
                    $c=0;$i=0;$tot=0;$a=1;
                    if(mysqli_num_rows($rez)>0){
                    while($e=mysqli_fetch_assoc($rez)){
     
                     $cart_id=$e['cart_id'];
                     $qty=$e['quantity']; 
                     $i+=$qty;
                     $price=$e['rate']; 
                     $subtot=$qty*$price;
                     $tot+=$subtot;
                     
                
                   
                
                ?>
               
                              <tr class="rem1">
                                 <td class="invert"><?php echo $a; ?></td>
                                 <td class="invert-image">
                                 <?php echo '<img src="admin/upload/'.$e['item_img'].'" alt="image" class="img-fluid" width="100px" height="100px">'?>
                                 </td>
                                 <td class="invert">
                                    <div class="quantity">
                                       <div class="quantity-select">
                                          <!-- <div class="entry value-minus">&nbsp;</div> -->
                                          <form method="POST">
                                          <input type="text" name="cart_id" value="<?php  echo $cart_id;  ?>" hidden>
                                          <input type="text" name="quantity"  value="<?php echo $e['quantity']?>" size="10px;" style="padding:0px 10px;">
                                        <div class=""><button type="submit" name="update" class="btn btn-outline-primary">update</button></form></div>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="invert"><?php echo $e['item_name']?></td>
                                 <td class="invert"><?php echo $e['rate']?></td>
                                 <td class="invert"><?php echo $subtot." Rs";?></td>
                                 <td class="invert">
                                    <div class="rem">
                                       <div><a href="?delete=<?php echo $cart_id; ?>" ><button class="super" name="submit" style="border:none;outline:none;">X</button></a></div>
                                    </div>
                                 </td>
                                 
                              </tr>
                           
                              <?php $a++; } } ?>
                           
                           </tbody>
                        </table>
                     </div>
                     <div class="checkout-right">
                        <div class="col-md-4 checkout-right-basket">
                           <ul>
                           <table class="timetable_sub">
                               <li>Total <i>-</i> <span> <?php echo $tot." Rs";?></span></li> 
                           </table>
                           </ul>
                        </div>
                        
                        
                        <div class="col-md-8 address_form">
                           
                           <form action="checkout.php" method="POST" class="creditly-card-form agileinfo_form">
                              <section class="creditly-wrapper wrapper">
                                 <div class="information-wrapper">
                                    <div class="first-row form-group">
                                    <!-- <button type="submit" class="btn btn-outline-primary">checkout</button> -->
                              </section>
                           </form>
                     
                        </div>
                        <div class="clearfix"> </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <div class="checkout-right">
                  <div class="col-md-4 checkout-right-basket">
                <button type="submit" onclick="window.location.href='youorder.php'">your order</button>
                 
               <button type="submit"  <?php 
                 if($tot > 25000){ echo "disabled"; } ?> onclick='location.href="checkout.php?mode=cash"' class="btn btn-outline-primary">cash on delivery</button>
                 
               <button type="submit" onclick='location.href="checkout.php?mode=cheque"'  class="btn btn-outline-primary">cheque</button>
               </div>
               <!-- //top products -->
            </div>
      </section>
      
      
      
      <!-- Modal 1-->
     <!-- //Modal 1-->
      <!--js working-->
      <script src='olaka/jumbo/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- cart-js -->  
      <script src="olaka/jumbo/minicart.js"></script>
      <script>
         toys.render();
         
         toys.cart.on('toys_checkout', function (evt) {
          var items, len, i;
         
          if (this.subtotal() > 0) {
            items = this.items();
         
            for (i = 0, len = items.length; i < len; i++) {}
          }
         });
      </script>
      <!--// cart-js -->
      <!--quantity-->
      <script>
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
      </script>
      <!--quantity-->
      <!--closed-->
      <script>
         $(document).ready(function (c) {
          $('.close1').on('click', function (c) {
            $('.rem1').fadeOut('slow', function (c) {
              $('.rem1').remove();
            });
          });
         });
      </script>
      <script>
         $(document).ready(function (c) {
          $('.close2').on('click', function (c) {
            $('.rem2').fadeOut('slow', function (c) {
              $('.rem2').remove();
            });
          });
         });
      </script>
      <script>
         $(document).ready(function (c) {
          $('.close3').on('click', function (c) {
            $('.rem3').fadeOut('slow', function (c) {
              $('.rem3').remove();
            });
          });
         });
      </script>
      <!--//closed-->
      <!-- start-smoth-scrolling -->
      <script src="olaka/jumbo/move-top.js"></script>
      <script src="olaka/jumbo/easing.js"></script>
      <script>
         jQuery(document).ready(function ($) {
          $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({
              scrollTop: $(this.hash).offset().top
            }, 900);
          });
         });
      </script>
      <!-- start-smoth-scrolling -->
      <!-- here stars scrolling icon -->
      <script>
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
      </script>
      <!-- //here ends scrolling icon -->
      <!--bootstrap working-->
      <script src="olaka/jumbo/bootstrap.min.js"></script>
      <!-- //bootstrap working-->
   </body>
</html>