<?php  
ob_start();
include ("header.php");

 if(!isset($_SESSION['USER_LOGIN'])){
header("location:./login_reg.php");
} 
?>
        
		
    <div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your Orders</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>

                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                       $query="select * from tbl_order_master where Cust_id='$c_id'";
                                       $query_run=mysqli_query($con,$query);
                                      while($row=mysqli_fetch_array($query_run)){
                                          ?>

                     <tr>
                          <td><?php echo $row['Morder_id']?></td>
                          <td><?php echo $row['order_date']?></td>
                          <td> <span class='badge badge-pending'><a href="myorder_item.php?id=<?php  echo $row['Morder_id']?>">View Items</a></span></td>
                           <td>Rs.<?php echo $row['tot_amt']?></td> 
                          <td><?php echo $row['Order_status']?></td>
                          

                     </tr>
                                    <?php   } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="shop.php">Continue Shopping</a>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
<?php
include("footer.php");
?>        
<!-- 		<div class="footer-area black-bg-2 pt-70">
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
