<?php 
include('top.php');

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['Alloc_id']) && $_GET['Alloc_id']>0){
	$type=get_safe_value($_GET['type']);
	$Alloc_id=get_safe_value($_GET['Alloc_id']);
	if($type=='delete'){
		mysqli_query($con,"delete from tbl_allocation where Alloc_id='$Alloc_id'");
		redirect('allocation.php');
	}

}

$sql="select tbl_allocation.*, tbl_staff.Staff_name, tbl_stall.Stall_name from from tbl_allocation, tbl_staff, tbl_stall where tbl_allocation.Staff_id=tbl_staff.Staff_id and tbl_allocation.Stall_id=tbl_stall.Stall_id ";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Allocation </h1>
			  <a href="manage_allocation.php" class="add_link">Add Allocation</a>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="15%">Staff Name</th>
                            <th width="20%">Stall Name</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            
                            <td><?php echo $row['Staff_name']?></td>
							<td><?php echo $row['Stall_name']?></td>
							<td>
								<a href="manage_allocation.php?Alloc_id=<?php echo $row['Alloc_id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
							
								&nbsp;
								<a href="?Alloc_id=<?php echo $row['Alloc_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
							</td>
                           
                        </tr>
                        <?php 
						   ?>
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