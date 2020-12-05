<?php 
include('top.php');
Ob_start();

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['Staff_id']) && $_GET['Staff_id']>0){
	$type=get_safe_value($_GET['type']);
  $Username=get_safe_value($_GET['Username']);
	$Staff_id=get_safe_value($_GET['Staff_id']);
	if($type=='delete'){
		mysqli_query($con,"delete from tbl_staff where Staff_id='$Staff_id'");
    mysqli_query($con,"delete from tbl_login where Username='$Username'");
		redirect('staff.php');
	}

}

$sql="select * from tbl_staff order by Staff_id";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Staff</h1>
			  <a href="manage_staff.php" class="add_link">Add Staff</a>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                        	 <th width="5%">#id</th>
                            <th width="5%">Name</th>
                            <th width="5%">Username</th>
                            <th width="5%">House name</th>
                            <th width="5%">Street Name</th>
                            <th width="5%">Pincode</th>
                            <th width="5%">City</th>
                            <th width="5%">Phone</th>
                            <th width="10%">DOB</th>
                            <th width="10%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $row['Staff_id']?></td>
                            <td><?php echo $row['Staff_name']?></td>
                            <td><?php echo $row['Username']?></td>
                            <td><?php echo $row['Staff_hname']?></td>
                            <td><?php echo $row['Street_name']?></td>
                            <td><?php echo $row['Staff_pin']?></td>
                            <td><?php echo $row['Staff_city']?></td>
                            <td><?php echo $row['Staff_phone']?></td>
							              <td><?php echo $row['Staff_dob']?></td>
							<td>
								<a href="manage_staff.php?Staff_id=<?php echo $row['Staff_id']?>&& Username=<?php echo $row['Username']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
							
								&nbsp;
								<a href="?Staff_id=<?php echo $row['Staff_id']?> && Username=<?php echo $row['Username']?>&type=delete"><i class="fas fa-trash"><label class="badge badge-danger delete_red">Delete</label></a>
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