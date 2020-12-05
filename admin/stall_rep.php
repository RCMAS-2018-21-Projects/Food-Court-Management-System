<?php
require('top.php');


			$sr="select * from tbl_stall";
		
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
	}

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Stall Report</h4>
				   <h4 class="box-link"><a href="report.php">Back</a></h4>
				
				               
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">S.no</th>
							   <th>Stall id</th>
							   <th>Stall_name</th>							 
							   <!-- <th>Name</th> -->
							   <th>No of Staff</th>
							 
							   <!-- <th>Total.No Items Purchased</th> -->
							    
							  				
							
							   
							   
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$tot=0;$qtr=0;
							while($row=mysqli_fetch_assoc($res)){

                                $id=$row['Stall_id'];
		                        $name=$row['Stall_name'];
	                       
	                            $r3=mysqli_query($con,"select COUNT(*) AS c ,Stall_id FROM tbl_allocation where tbl_allocation.Stall_id='$id'");
	                            $y=mysqli_fetch_assoc($r3);
	                            $c=$y['c'];
	                            $Stall_id=$y['Stall_id'];
                              

	                            /*$r4=mysqli_query($con,"select *from tbl_order_child where order_id='$oid'");
	                            $y1=mysqli_fetch_assoc($r4);
	                            $vn=$y1['vendor_name'];*/

	                          

								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $id?></td>
												 
							   <td><?php echo $name;?></td>
							  
							 							   
							   <td><?php echo $c;?></td>
							  
                              <!--  <?php 


                                // $r32=mysqli_query($con,"select *from tbl_order_master where Cust_id='$cid'");
	                            $r32=mysqli_query($con,"select tbl_order_master.*,tbl_order_child.* from tbl_order_master,tbl_order_child where tbl_order_master.Morder_id=tbl_order_child.Morder_id and tbl_order_child.Morder_id='$Morder_id'");
	                            

                                 $qt=0;$tamt=0;
                               while($y2=mysqli_fetch_assoc($r32)){

                               	$amt=$y2['tot_amt'];
                               	$tamt+=$amt;
                               	$t=$y2['Quantity'];
                               	$qt+=$t;
                               }

                               ?>
                                <td align="left"><?php echo number_format($tamt)." Rs";?></td> -->
							   <!--   <td><span class='badge badge-edit'><a href="Cust_itm.php?id=<?php echo $cid; ?>">Items</a></span></td> -->
							
							</tr>
							<?php $i+=1; } ?>
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