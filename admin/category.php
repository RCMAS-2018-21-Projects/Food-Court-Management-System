<?php 
include('top.php');

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['Cat_id']) && $_GET['Cat_id']>0){
	$type=get_safe_value($_GET['type']);
	$Cat_id=get_safe_value($_GET['Cat_id']);
	if($type=='delete'){
		mysqli_query($con,"delete from tbl_cat where Cat_id='$Cat_id'");
		redirect('category.php');
	}

}

$sql="select * from tbl_cat order by Cat_id";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Category </h1>
			  <a href="manage_category.php" class="add_link">Add Category</a>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                        	<th width="15%">#id</th>
                            <th width="15%">Category Name</th>
                            <th width="20%">Description</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $row['Cat_id']?></td>
                            <td><?php echo $row['Cat_name']?></td>
							<td><?php echo $row['Description']?></td>
							<td>
								<a href="manage_category.php?Cat_id=<?php echo $row['Cat_id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
							
								&nbsp;
								<a href="?Cat_id=<?php echo $row['Cat_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
							</td>
                           
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
<?php include('footer.php');?>