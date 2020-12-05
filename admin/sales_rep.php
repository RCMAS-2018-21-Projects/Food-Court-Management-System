<?php

require('top.php');
						if(isset($_GET['from']) && isset($_GET['to'])){
	$from=get_safe_value($_GET['from']);
	$to=get_safe_value($_GET['to']);
}
?>
<div id='printMe'>
<div class="content pb-0">

	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Sales Report:</h4>
				   <h5><?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
				               if(isset($_GET['all']));?></h5>
				   <h4 class="box-link"><a href="sales.php">Back</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Item Name</th>
							   <th>Quantity</th>
							   <th>Amount</th>
							      <?php if(isset($_GET['all'])){  ?>
							   <th>Date</th>
							   <?php }?>
							   <!-- <th>Cust_id</th> -->
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
						<?php 
							
							if(isset($_GET['from']) && isset($_GET['to'])){
								$i=1;$p=0;$tot=0;
	$from=get_safe_value($_GET['from']);
	$to=get_safe_value($_GET['to']);
	if($to=='')
	{
		$to=date("Y-m-d");
	}
		$sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust where tbl_order_master.Morder_id=tbl_order_child.Morder_id AND tbl_order_master.Cust_id=tbl_cust.Cust_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.order_date BETWEEN DATE('$from') AND DATE('$to')";
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
	}


		while ($row=mysqli_fetch_assoc($res)){
			$trt=$row['Quantity'];
			$p+=$trt;
			$su=$row['Item_price']*$row['Quantity'];
			$tot+=$su;
?>



							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_name']?></td>
							   <td><?php echo $row['Quantity']?></td>
							   <td><?php echo number_format($row['Item_price']*$row['Quantity'])." Rs";?></td>
							  <!--   <td><?php echo $row['cust_id']?></td> -->
							</tr>
							<?php 
							  $i+=1;
						      }} ?>

	<?php 
							
							if(isset($_GET['all'])){
								$i=1;$p=0;$st=0;

		$sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust where tbl_order_master.Morder_id=tbl_order_child.Morder_id AND tbl_order_master.Cust_id=tbl_cust.Cust_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.order_date <= CURDATE()";
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
	}


		while ($row=mysqli_fetch_assoc($res)){
			$trt=$row['Quantity'];
			$p+=$trt;
			$tot=$row['tot_amt'];
			$t=$row['Item_price']*$row['Quantity'];
			$st+=$t;
			$dat=$row['order_date'];
?>          



							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_name']?></td>
							   <td><?php echo $row['Quantity']?></td>
							   <td><?php echo number_format($row['Item_price']*$row['Quantity'])." Rs";?></td>
							   <!--  <td><?php echo $row['cust_id']?></td> -->

                               <td><?php echo $dat;?></td>
							    	
							</tr>
							<?php 
							  $i+=1;
						      }} ?>
						 </tbody>
					  </table>
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial"></th>
							   
							   <th> Total No.items</th>
							   <th>Total amount</th>
							   
							</tr>
						 </thead>
						 <tbody>

							<tr>
							   <td class="serial"></td>
							   
							   <td><?php echo $p?></td>
							    <td><?php if(isset($_GET['all'])){echo number_format($st)." Rs";}if(isset($_GET['from']) && isset($_GET['to'])){echo number_format($tot)." Rs";}?></td>
							</tr>
						</tbody>
					</table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
</div>
<button onclick="printDiv('printMe')">Print </button>
<script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
<!-- <input type="button" onClick="window.print()" value="Print The Report"/> -->
<?php
require('footer.php');
ob_end_flush();
?>