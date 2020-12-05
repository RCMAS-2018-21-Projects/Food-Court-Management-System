<?php
require('header.php');
if(!isset($_SESSION['IS_LOGIN'])){
header("location:./login_register.php");
 }
 else{
 
if(isset($_GET['id'])){
  
  $id=get_safe_value($_GET['id']);
  $res=mysqli_query($con,"select * from tbl_order_child where Morder_id='$id'");
 
  }

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
                                            <th width="30%" >Product</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">Quantity</th> 
                                            <th width="30%">Price</th> 
                                            <th width="30%">Total</th> 
                                            <th width="30%">Stall Name</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                       $i=1;
                                 while($row=mysqli_fetch_assoc($res)){ 
                              $item_id=$row['Item_id']; 
                              $qty=$row['Quantity'];

                             // $Item_pres=$row['Item_pres'];
                              //$r3=mysqli_query($con,"select *from tbl_item where Item_id='$item_id'");
                              $r3=mysqli_query($con,"select tbl_item.*,tbl_stall.* from tbl_item,tbl_stall where tbl_stall.Stall_id=tbl_Item.Stall_id and Item_id='$item_id'");
                              $y=mysqli_fetch_assoc($r3);
                              $name=$y['Item_name'];
                              $Item_price=$y['Item_price'];
                              $Stall_name=$y['Stall_name'];
                              $tot=$qty*$Item_price;

                                  ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <?php echo '<img src="admin/upload/'.$y['Item_image'].'" alt="image" class="img-fluid" width="100px" height="100px">'?>
                                            </td>
                                            <td ><?php echo $name?></td>
                                            <td ><span class="amount"><?php echo $qty?></span></td>
                                            <td>Rs.<?php echo $Item_price?></td> 
                                            <td>Rs.<?php echo $tot?></td> 
                                            <td><?php echo $Stall_name?></td> 
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
          
                <!-- <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$230.00</strong>
                  </div>
                </div> -->
                
    


                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="myorder.php">Back to Orders</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                         
                    </div>
                </div>
            </div>
        </div>
        
        
<?php require('footer.php')?>
        