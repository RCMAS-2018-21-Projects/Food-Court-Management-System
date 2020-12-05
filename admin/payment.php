<?php
require('top.php');
$sql="select * from tbl_pay";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				<!-- <?php echo $_SESSION['ADMIN_USERNAME']; ?> -->
				   <h4 class="box-title">PAYMENT<hr>
				   <!-- <a href="manage_categories.php"><button class="btn" style="border-color:#75B239;background-color: white;color: black">Add Category</button></a> </h4>  -->
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>PAYMENT ID</th>
							   <th>ORDER ID</th>
                               <th>PAYMENT DATE</th>
                               <!-- <th>PAYMENT AMOUNT</th> -->
                               <th>PAYMENT Type</th>
                               <th>CARD NO</th>
                               <th>PAYMENT STATUS</th>
							  <!-- <th>     </th> -->
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['payment_id']?></td>
							   <td><?php echo $row['Morder_id']?></td>
							   <td><?php echo $row['P_date']?></td>
                               <!-- <td><?php echo $row['pay_amt']?></td> -->
                               <td><?php echo $row['P_type']?></td>
                               <td><?php echo $row['Card_no']?></td>
							   <td><?php echo $row['P_status']?></td>
                               <!-- <td><?php echo "<span class='badge badge-edit'><a href='show_order.php?id=".$row['Morder_id']."'>STATUS</a></span>&nbsp;"; ?> </td> -->
                              
							</tr>
							<?php $i=$i+1;} ?>
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