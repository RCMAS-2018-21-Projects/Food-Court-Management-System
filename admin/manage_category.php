<?php 
include('top.php');
$msg="";
$Cat_name="";
$Description="";			
$Cat_id="";

if(isset($_GET['Cat_id']) && $_GET['Cat_id']>0){
	$Cat_id=get_safe_value($_GET['Cat_id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from tbl_cat where Cat_id='$Cat_id'"));
	$Cat_name=$row['Cat_name'];
	$Description=$row['Description'];
}

if(isset($_POST['submit'])){
	$Cat_name=get_safe_value($_POST['Cat_name']);
	$Description=get_safe_value($_POST['Description']);
	
	
	if($Cat_id==''){
		$sql="select * from tbl_cat where Cat_name='$Cat_name'";
	}else{
		$sql="select * from tbl_cat where Cat_name='$Cat_name' and Cat_id!='$Cat_id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}
	else{
		if($Cat_id==''){
			mysqli_query($con,"insert into tbl_cat(Cat_name,Description) values('$Cat_name','$Description')");
		}else{
			mysqli_query($con,"update tbl_cat set Cat_name='$Cat_name', Description='$Description' where Cat_id='$Cat_id'");
		}
		
		redirect('category.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control" placeholder="Category name" name="Cat_name" required value="<?php echo $Cat_name?>">
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