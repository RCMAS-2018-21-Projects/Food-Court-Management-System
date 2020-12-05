<?php 
include('top.php');

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['Stall_id']) && $_GET['Stall_id']>0){
	$type=get_safe_value($_GET['type']);
	$Stall_id=get_safe_value($_GET['Stall_id']);
	if($type=='delete'){
		mysqli_query($con,"delete from tbl_stall where Stall_id='$Stall_id'");
		redirect('stall.php');
	}

}

$sql="select * from tbl_stall order by Stall_id";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Stall </h1>
			  <a href="manage_stall.php" class="add_link">Add Stall</a>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="20%">#id</th>
                            <th width="15%">Stall Name</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $row['Stall_id']?></td>
                            <td><?php echo $row['Stall_name']?></td>
							<td>
								<a href="manage_stall.php?Stall_id=<?php echo $row['Stall_id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
							
								&nbsp;
								<a href="?Stall_id=<?php echo $row['Stall_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
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