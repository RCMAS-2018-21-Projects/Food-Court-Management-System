<?php 
include('top.php');

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['Morder_id']) && $_GET['Morder_id']>0){
	$type=get_safe_value($_GET['type']);
	$Morder_id=get_safe_value($_GET['Morder_id']);
	if($type=='delete'){
		mysqli_query($con,"delete from tbl_ordermaster where Morder_id='$Morder_id'");
		redirect('order.php');
	}

}

$sql="select tbl_order_master.*, tbl_cust.Cust_name from tbl_order_master,tbl_cust where tbl_order_master.Cust_id=tbl_cust.Cust_id order by Morder_id desc";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Orders </h1>
			  <!-- <a href="manage_manage.php" class="add_link">Edit Order</a> -->
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">Order id</th>
                            <th width="5%">Cust id</th>
                            <th width="15%">Cust Name</th>
                            <th width="10%">Date</th>
                            <th width="10%">Total</th>
							              <th width="5%">Ordered Items</th>
                            <th width="10%">Status</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            
                            <td><?php echo $row['Morder_id']?></td>
                            <td><?php echo $row['Cust_id']?></td>
                            <td><?php echo $row['Cust_name']?></td>
                            <td><?php echo $row['order_date']?></td>
                            <td>Rs.<?php echo $row['tot_amt']?></td>
                            <td> <span class='badge badge-pending'><a href="order_item.php?id=<?php  echo $row['Morder_id']?>">View Items</a></span></td>
							<td><?php echo $row['Order_status']?></td>
							<td>
								<a href="manage_order.php?Morder_id=<?php echo $row['Morder_id']?>"><label class="badge badge-success">Update Status</label></a>&nbsp;
							
								&nbsp;
								<a href="?Morder_id=<?php echo $row['Morder_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
							</td>
                           
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
<?php include('footer.php');?>