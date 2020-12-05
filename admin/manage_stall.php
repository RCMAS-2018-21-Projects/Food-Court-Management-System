<?php 
include('top.php');
$msg="";
$Stall_name="";
//$Stall_no="";			
$Stall_id="";

if(isset($_GET['Stall_id']) && $_GET['Stall_id']>0){
	$Stall_id=get_safe_value($_GET['Stall_id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from tbl_stall where Stall_id='$Stall_id'"));
	$Stall_name=$row['Stall_name'];
	//$Stall_no=$row['Stall_no'];
}

if(isset($_POST['submit'])){
	$Stall_name=get_safe_value($_POST['Stall_name']);
	//$Stall_no=get_safe_value($_POST['Stall_no']);
	
	
	if($Stall_id==''){
		$sql="select * from tbl_stall where Stall_name='$Stall_name'";
	}else{
		$sql="select * from tbl_stall where Stall_name='$Stall_name' and Stall_id!='$Stall_id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Stall already added";
	}
	else{
		if($Stall_id==''){
			
			mysqli_query($con,"insert into tbl_stall(Stall_name) values('$Stall_name')");
		}else{
			mysqli_query($con,"update tbl_stall set Stall_name='$Stall_name' where Stall_id='$Stall_id'");
		}
		
		redirect('Stall.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Stall</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Stall Name</label>
                      <input type="text" class="form-control" placeholder="Stall name" name="Stall_name" required value="<?php echo $Stall_name?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <!--<div class="form-group">
                      <label for="exampleInputEmail3" required>Stall no</label>
                      <input type="textbox" class="form-control" placeholder="Stall no" name="Stall_no"  value="<?php echo $Stall_no?>">
                    </div>-->
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>