<?php 
include('top.php');
$Morder_id='';
if(isset($_GET['id'])&&$_GET['id']){
	
	$Morder_id=get_safe_value($_GET['id']);
		

	//$sql= "select * from tbl_order_child where Morder_id='$Morder_id'";

	$res=mysqli_query($con,"select * from tbl_order_child where Morder_id='$Morder_id'");
	if(!$res)
	{
		echo "error".mysqli_error($con);
	}

}
?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Ordered Items </h1>
			  <h4 class="box-link"><a href="order.php">Back</a></h4>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th class="serial">#</th>
							   <th>Item Name</th>				 
							   <th>Quantity</th>				
							   <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){

						$i=1;
						while($row=mysqli_fetch_assoc($res)){
								$Item_id=$row['Item_id'];
								

	                            $qty=$row['Quantity']; 
	                            $r3=mysqli_query($con,"select * from tbl_item where Item_id='$Item_id'");
	                            $y=mysqli_fetch_assoc($r3);
								$name=$y['Item_name'];
								
						?>
						<tr>
                            
							   <td class="serial"><?php echo $Item_id?></td>
							   <td><?php echo $name ?></td>				 
							   <td><?php echo $qty ?></td>
                            
                           
                        </tr>
                        <?php 
						$i++;
						} }if(!$res) { ?>
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