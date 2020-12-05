<?php 
include('top.php');

if(isset($_GET['from']) && isset($_GET['to'])){
  $from=get_safe_value($_GET['from']);
  $to=get_safe_value($_GET['to']);
}
?>
  <div class="card" id='printMe'>
            <div class="card-body">
              <h1 class="grid_title">Order Report: </h1>
			         <h5><?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
                       if(isset($_GET['all']));?></h5>
              
				      <h4 class="box-link"><a href="orderrep.php">Back</a> </h4>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                        	<th class="serial">S.no</th>
                 <th>Cust Name</th>
                 <th>Staff Name</th>
                 <th>Stall Name</th>
                 <th>Item Name</th>
                 <th>Quantity</th>
                 <th>Amount</th>
                    <?php if(isset($_GET['all'])){  ?>
                 <th>Date</th>
                 <?php }?>
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
    $sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.*,tbl_staff.*,tbl_stall.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust,tbl_staff,tbl_stall where tbl_order_master.Morder_id=tbl_order_child.Morder_id AND tbl_order_master.Cust_id=tbl_cust.Cust_id AND tbl_order_master.Staff_id=tbl_staff.Staff_id AND tbl_stall.Stall_id=tbl_item.Stall_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.order_date BETWEEN DATE('$from') AND DATE('$to')";
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
                 <td><?php echo $i?></td>
                 <td><?php echo $row['Cust_name']?></td>
                 <td><?php echo $row['Staff_name']?></td>
                 <td><?php echo $row['Stall_name']?></td>
                 <td><?php echo $row['Item_name']?></td>
                 <td><?php echo $row['Quantity']?></td>
                 <td><?php echo number_format($row['Item_price']*$row['Quantity'])." Rs";?></td>
                <!--   <td><?php echo $row['cust_id']?></td> -->
              </tr>
                        <?php 
						$i++;
						} }  ?>
            <?php 
              
              if(isset($_GET['all'])){
                $i=1;$p=0;$st=0;

    $sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.*,tbl_staff.*,tbl_stall.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust,tbl_staff,tbl_stall where tbl_order_master.Morder_id=tbl_order_child.Morder_id AND tbl_order_master.Cust_id=tbl_cust.Cust_id AND tbl_order_master.Staff_id=tbl_staff.Staff_id AND tbl_stall.Stall_id=tbl_item.Stall_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.order_date <= CURDATE()";
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
                 <td><?php echo $row['Cust_name']?></td>
                 <td><?php echo $row['Staff_name']?></td>
                 <td><?php echo $row['Stall_name']?></td>
                 <td><?php echo $row['Item_name']?></td>
                 <td><?php echo $row['Quantity']?></td>
                 <td><?php echo number_format($row['Item_price']*$row['Quantity'])." Rs";?></td>
                 <!--  <td><?php echo $row['cust_id']?></td> -->

                               <td><?php echo $dat;?></td>
						</tr>
						<?php 
            $i++;
            } } else { ?>
              <tr>
              <!-- <td colspan="5">No data found</td> -->
            </tr>
            <?php } ?>
                      </tbody>
                    </table>
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
        
<?php include('footer.php');?>