<?php
ob_start();
require('top.php');
$categories='';
$msg='';
$from='';
$to='';
if(isset($_POST['submit'])){
	$from=get_safe_value($_POST['from']);
	$to=get_safe_value($_POST['to']);
	if($to=='')
	{
		$to=date("Y-m-d");
		
	}
	$sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust where tbl_order_master.Morder_id=tbl_order_child.Morder_id AND tbl_order_master.Cust_id=tbl_cust.Cust_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.order_date BETWEEN DATE('$from') AND DATE('$to')";
	$res=mysqli_query($con,$sr);
/*	if(!$res)
	{
		mysqli_error($con);
	}*/

	$check=mysqli_num_rows($res);
	if($check>0){

     header("location:sales_rep.php?from=$from&to=$to");
 

	
		
	}
	else
	{
		$msg=" No data found";
	}
	

	}


?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" >
                        <div class="card-body"><strong>Sales Report</strong></div>
                        <h4 class="box-link"><a href="report.php"><button type="button" style="margin-left:30px" class="btn btn-primary mr-2">Back</button></a></h4>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">From</label>
									<input type="date" name="from" placeholder="Enter categories name" class="form-control"  value="<?php echo $categories?>" required>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">To</label>
									<input type="date" name="to" placeholder="Enter categories name" class="form-control"  value="<?php echo $categories?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-primary mr-2">
							   <span id="btn btn-primary mr-2">Submit</span>
							   </button>
							   
                                
							  
							   <div class="field_error"><?php echo $msg?></div>

							</div>
						</form>
						<a href="sales_rep.php?all=1"><button style="margin-left:150px;margin-top:-125px;" id="payment-button" name="all" type="submit" class="btn btn-primary mr-2">Get All
							   </button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.php');
?>