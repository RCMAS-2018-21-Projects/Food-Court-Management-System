<?php 
include('top.php');
$msg="";
$Subcat_name="";
$Description="";			
$Subcat_id="";

if(isset($_GET['Subcat_id']) && $_GET['Subcat_id']>0){
	$Subcat_id=get_safe_value($_GET['Subcat_id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from tbl_subcat where Subcat_id='$Subcat_id'"));
	$Subcat_name=$row['Subcat_name'];
	$Description=$row['Description'];
}

if(isset($_POST['submit'])){
	$Subcat_name=get_safe_value($_POST['Subcat_name']);
	$Description=get_safe_value($_POST['Description']);
	
	
	if($Subcat_id==''){
		$sql="select * from tbl_subcat where Subcat_name='$Subcat_name'";
	}else{
		$sql="select * from tbl_subcat where Subcat_name='$Subcat_name' and Subcat_id!='$Subcat_id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Sub Category already added";
	}
	else{
		if($Subcat_id==''){
			//mysqli_query($con,"insert into tbl_subcat(Subcat_name,Description) values('$Subcat_name','$Description')");
			$sql = "insert into tbl_subcat(Subcat_name,Description) values ('$Subcat_name','$Description')";
            mysqli_query($con, $sql) or die(mysqli_error($con));
		}else{
			mysqli_query($con,"update tbl_subcat set Subcat_name='$Subcat_name', Description='$Description' where Subcat_id='$Subcat_id'");
		}
		
		redirect('sub_cat.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Sub Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Sub Category</label>
                      <input type="text" class="form-control" placeholder="Subcategory name" name="Subcat_name" required value="<?php echo $Subcat_name?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Description</label>
                      <input type="textbox" class="form-control" placeholder="Description" name="Description"  value="<?php echo $Description?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>