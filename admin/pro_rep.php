<?php
require('top.php');


$sql="select * from tbl_item";
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
}
?>
<div id='printMe'>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Food Item Report</h4>
				   <h4 class="box-link"><a href="report.php">Back</a></h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">S.no</th>
							   <th>ID</th>							 
							   <th>Item Name</th>
							   <th>Price</th>
							   <th>Availability</th>					
							   
							  
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$sold=0;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>

							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_id']?></td>
							   <?php 
							   $status=$row['Status'];
							   if($status==1)
                                {
                                	$s='Available';
                                }
                                else
                                {
                                	$s='Unavailable';
                                }
							   $it=$row['Item_id'];
                               $sw="select *from tbl_order_child where Item_id='$it'";
                                $e=mysqli_query($con,$sw);
                               while($d=mysqli_fetch_assoc($e)){
                                
                                

                            }
							   ?>						 
							   <td><?php echo $row['Item_name'];?></td>
							    <td><?php echo $row['Item_price'];?></td>
							    <td><?php echo $s;?></td>

							 							   
							  
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
<?php
require('footer.php');
?>