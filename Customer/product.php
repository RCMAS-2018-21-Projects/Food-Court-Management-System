
<?php
ob_start();
include ("header.php");
$Item_id=mysqli_real_escape_string($con,$_GET['id']);
if(isset($_POST['b-sub'])){
    $qty=$_POST['qty'];
header("Location: pay.php?id={$Item_id}&qty={$qty}");
}
if(isset($_POST['p-sub'])){
    $qty=$_POST['qty'];
header("Location: pay_counter.php?id={$Item_id}&qty={$qty}");
}
if(isset($_POST['p-poo'])){
    $qty=$_POST['qty'];
header("Location: checkout.php?id={$Item_id}&qty={$qty}");
}
?>

<?php

$m='';
       if(isset($_POST['button'])&&isset($_POST['qty'])&&isset($_POST['Item_id']))
          { 
              $Item_id=$_POST['Item_id'];
              $qty=$_POST['qty'];
              // $item_quantity=$_POST['qty'];
         /*     $_SESSION['cart'][$iid]['c_qty']=$c_qty;
               header("location:cart.php");*/
           if(isset($_SESSION['IS_LOGIN']))
           {
               //  $rus=$_SESSION['user_id'];
            // echo "select * from tbl_cart where Item_id='$Item_id' AND Cust_id='$c_id'";
                $s="select * from tbl_cart where Item_id='$Item_id' AND Cust_id='$c_id'";
                $res=mysqli_query($con,$s);
                
                
                if(mysqli_num_rows($res)>0){
                 
                     $m='Item already exist in Cart';
                    
                      }
                 else
                 {
                      // echo "insert into tbl_cart(Item_id,Cust_id,qty) Values('$Item_id','$c_id','$item_quantity')";
                     $ql="insert into tbl_cart(Item_id,Cust_id,qty) Values('$Item_id','$c_id','$qty')";
                     $result=mysqli_query($con,$ql);  
                     if(!$result)
                {
                echo "error".mysqli_error($con);
                die();
                }
                    if($result)
                    {
                       // header("location:cart.php");
                       $m='Added to Cart';
                    } 
                    else
                    {
                       echo "error".mysqli_error($con);
                    }  
                 } 
            }    
         
          else
          {
           
            //header("location:logout.php");
          
          }
        }
?>

        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">

                        
                        <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <div class="row">
                                    <?php
                                                     //$query="select * from tbl_item where Item_id='$Item_id'";
                                                     $query="select tbl_item.*, tbl_cat.Cat_name, tbl_subcat.Subcat_name, tbl_stall.Stall_name from tbl_item, tbl_cat,tbl_subcat,tbl_stall where tbl_item.Cat_id=tbl_cat.Cat_id and tbl_item.Subcat_id=tbl_subcat.Subcat_id and tbl_item.Stall_id=tbl_stall.Stall_id and Item_id='$Item_id'";
                                                     //echo $query;
                                                        $query_run=mysqli_query($con,$query);
                                                        if(!$query_run)
                                                         {
                                                          echo "error".mysqli_error($con);
                                                              die();
                                                         }
                                                     while($row=mysqli_fetch_array($query_run)){
                                                ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                
                                                   <?php echo '<img src="admin/upload/'.$row['Item_image'].'" alt="image" width="50px" height="220px" style="object-fit:cover;">'?>  
                                                
                                            </div>
                                            <div class="product-content">

                                                <h4>
                                                    <?php echo $row['Item_name'];?> <br>
                                                    <!-- <?php echo $row['Cat_name'];?><br>
                                                    <?php echo $row['Subcat_name'];?> -->
                                                </h4>

                                                <div class="product-price-wrapper">
                                                   <h4> <span>Rs.<?php echo $row['Item_price']?></span></h4>
                                                </div>
                                                <form   method="post">
                                                  <input type="number" name="qty" value=1 hidden>
                                                <!-- <input type="submit" name="b-sub" value="Pay Online" style="background:red;color:white;">
                                                <input type="submit" name="p-sub" value="Pay cash at Counter" style="background:red;color:white;">
                                                <input type="submit" name="p-poo" value="checkout" style="background:red;color:white;"> -->
                                                <?php
                                                $p=$row['Status'];
                                                 // echo $p;
                                                  if($p > 0)

                                                  {?>
                                                    <div class="product-quantity">
                                                    <button type="submit" name="button" class="btn btn-outline-primary">Add To Cart</button></div>
                                                <p style="color:red"><?php echo $m ;?></p>
                                                     <?php   }
                                                  else {
                                              echo "<h3>Currently Unavailable<h3>";
                                                     }
                                          ?>
                                                <!-- <button type="submit" name="button" class="btn btn-outline-primary">Add To Cart</button>
                                                <p style="color:red"><?php echo $m ;?></p> -->
                                                <input type="text" name="Item_id" value="<?php echo $row['Item_id'];  ?>" hidden>
                                                </form>
                                         
                                       
                                            </div>
                                        </div>
                                        
                                    </div>
                             <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="product-content">
                                
                                <ul  class="pro__prize">
                                  <li><h6>Stall:<?php echo $row['Stall_name'];?></h6> </li>
                                  <li><h6>Category:<?php echo $row['Cat_name'];?></h6>  </li>  
                                  <li><h6>Subcategory:<?php echo $row['Subcat_name'];?></h6></li> 
                                <li>
                                <p class="pro__info"><?php echo $row['Desc']?></p></li>
                                </ul>
                                <!-- <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
                                     <form method ="post"> 
                                    <input value=1 type="number" name='c_qty' style="width: 80px;">
                                    <div class="sin__desc align--left">
                                         <p><span>Categories:</span></p> 
                                       
                                    </div>
                                    <input type="text" name="Item_id" value="<?php echo $row['Item_id'];  ?>" hidden>
                                     <form method ="post">   
                                    <button type="submit" name="c-btn"  id="getbt" style="background: #000;color:#fff;padding: 5px;">Add to cart</button>
                                    <br><?php echo $m; ?>
                                     </form>
                                    </div> -->
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
                    </div></div>

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
