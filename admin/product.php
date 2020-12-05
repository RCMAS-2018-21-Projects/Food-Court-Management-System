<?php
require('top.php');

if(isset($_GET['type']) && $_GET['type']!=''){
   $type=get_safe_value($con,$_GET['type']);   
   if($type=='delete'){
      $id=get_safe_value($con,$_GET['Item_id']);
      $delete_sql="delete from tbl_item where Item_id='$Item_id'";
      mysqli_query($con,$delete_sql);
   }
}

$sql="select tbl_item.*,tbl_cat.Cat_name,tbl_subcat.Subcat_name from tbl_item,tbl_cat,tbl_subcat where tbl_item.Cat_id=tbl_cat.Cat_id and tbl_item.Subcat_id=tbl_subcat.Subcat_id order by tbl_item.Item_id ";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">Item</h4>
               <h4 class="box-link"><a href="manage_item.php">Add Item</a> </h4>
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        
                        <th>ID</th>
                        <th>Categories</th>
                        <th>Subcategories</th>
                        <th>Name</th>
                        
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Img</th>
                      
                     </tr>
                   </thead>
                   <tbody>
                     <?php 
                     $i=1;
                     while($row=mysqli_fetch_assoc($res)){?>
                     <tr>
                        
                        <td><?php echo $row['Item_id']?></td>
                        <td><?php echo $row['Cat_name']?></td>
                        <td><?php echo $row['Subcat_name']?></td>
                        <td><?php echo $row['Item_name']?></td>    
                        <td><?php echo $row['Item_price']?></td>
                        <td><?php echo $row['Item_qty']?></td>
                        <td><?php //echo $row['Item_img']?></td>
                        
                        <td>
                            <a href="manage_item.php?Item_id=<?php echo $row['Item_id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
              
                             &nbsp;
                            <a href="?Cat_id=<?php echo $row['Item_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>

                     
                        </td>
                     </tr>
                     <?php } ?>
                   </tbody>
                 </table>
               </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>
<?php
require('footer.php');
?>