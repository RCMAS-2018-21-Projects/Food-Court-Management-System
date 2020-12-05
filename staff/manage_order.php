<?php 
include('top.php');
$msg="";
$Order_status="";
//$Description="";			
$Morder_id="";
// echo $s_id;
$s='Succesfull';
$s1='Recieved';
if(isset($_GET['Morder_id']) && $_GET['Morder_id']>0){
	$Morder_id=get_safe_value($_GET['Morder_id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from tbl_order_master where Morder_id='$Morder_id'"));
	$Order_status=$row['Order_status'];
	//$Description=$row['Description'];
}

if(isset($_POST['submit'])){
	$Order_status=get_safe_value($_POST['Order_status']);
	//$Description=get_safe_value($_POST['Description']);
	
	
	if($Morder_id==''){
		  $sql="select * from tbl_order_master where Order_status='$Order_status'";
	// 	$sql="select * from tbl_order_master where Order_status='$Order_status' and Morder_id!='$Morder_id'";
	// 
		}
	else{
		$sql="select * from tbl_order_master where Order_status='$Order_status' and Morder_id='$Morder_id'";
	
		}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}
	else{
		//echo "update tbl_order_master set Order_status='$Order_status' Staff_id='$s_id' where Morder_id='$Morder_id'";
			mysqli_query($con,"update tbl_order_master set Order_status='$Order_status', Staff_id='$s_id' where Morder_id='$Morder_id'");
			if($Order_status==$s1)
			{
			$ak= "update tbl_pay set P_status='$s' where Morder_id='$Morder_id' ";
			$res=mysqli_query($con,$ak);
			if(!$res)
			{
				echo "invalid".mysqli_error($con);
			}
			// echo $res;
		}
				//echo "update tbl_pay set P_status='$s' where Morder_id='$Morder_id' and Order_status='$s1'";
			//echo "update tbl_order_master set Order_status='$Order_status', Staff_id='$s_id' where Morder_id='$Morder_id'";
		}
		
		redirect('order.php');
	}

?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Order Status</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
<!--                     <div class="form-group">
                      <label for="exampleInputName1">Status</label>
                      <input type="text" class="form-control" placeholder="Status" name="Order_status" required value="<?php echo $Order_status?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div> -->

                    <div class="form-group">
                            <label for="Order_status" class=" form-control-label">Order Status</label>
                            <select class="form-control" name="Order_status">                                   
                              <?php
                               $res=mysqli_query($con,"select *from tbl_order_master ");
                               $row=mysqli_fetch_assoc($res);
                              if($row['Morder_id']==$Morder_id){
                        echo "<option selected value=".$row['Morder_id'].">".$row['Order_status']."</option>";
                      }else{
                        echo "<option value=".$row['Morder_id'].">".$row['Order_status']."</option>";
                      }
                  
                      ?>
                      		  <option value="Pending">Pending</option>
                      		  <option value="Ready">Ready</option>
                      		  <option value="Recieved">Recieved</option>
                            </select>
                          </div>


                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>