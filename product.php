
<?php
include ("header.php");
$Item_id=mysqli_real_escape_string($con,$_GET['id']);
?>

        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">

                        
                        <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <div class="row">
                                    <?php
                                                     $query="select * from tbl_item where Item_id='$Item_id'";
                                                        $query_run=mysqli_query($con,$query);
                                                     while($row=mysqli_fetch_array($query_run)){
                                                ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                
                                                   <?php echo '<img src="admin/upload/'.$row['Item_image'].'" alt="image" >'?>  
                                               
                                            </div>
                                            <div class="product-content">

                                                <h4>
                                                    <?php echo $row['Item_name'];  $id=$row['Item_name'];?> 
                                                </h4>
                                                <div class="product-price-wrapper">
                                                   <h4> <span>Rs.<?php echo $row['Item_price']?></span></h4>
                                                </div>
                                                                                    <div class="shop-widget">
                                            <a href="login_register.php?id=<?php echo $id?>">Shop Now</a>
                                        </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    ?>    
                                </div>
                            </div>
                          </div>
                        </div>
                    

                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                        <?php
                                        foreach ($cat_arr as $list){
                                            ?>
                                           <li><a href="categories.php?id=<?php echo $list['Cat_id']?>"><?php echo $list['Cat_name']?></a></li>
                                            <?php
                                          }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                                                                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Order By SubCategories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                        <?php
                                        foreach ($scat_arr as $list){
                                            ?>
                                           <li><a href="subcategories.php?id=<?php echo $list['Subcat_id']?>"><?php echo $list['Subcat_name']?></a></li>
                                            <?php
                                          }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        
        <div class="footer-area black-bg-2 pt-70">
            <div class="footer-bottom-area border-top-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-7">
                           
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
    </body>

<!-- Mirrored from demo.hasthemes.com/billy-preview/billy/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jun 2020 19:15:26 GMT -->
</html>
