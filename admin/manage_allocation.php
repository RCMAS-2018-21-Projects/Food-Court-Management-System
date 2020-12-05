<?php
include('top.php');
$Staff_id='';
$Stall_id='';
$Item_price='';
$Item_name='';
$Item_qty='';
$Alloc_id='';

 $msg='';

if(isset($_GET['Alloc_id']) && $_GET['Alloc_id']!=''){
    $Alloc_id=get_safe_value($_GET['Alloc_id']);
    $res=mysqli_query($con,"select * from tbl_allocation where Alloc_id='$Alloc_id'");
    $check=mysqli_num_rows($res);
  if($check>0){
    $row=mysqli_fetch_assoc($res);
    $Staff_id=$row['Staff_id'];
    $Stall_id=$row['Stall_id'];
}
else{
    header('location:allocation.php');
    die();
  }
}

if(isset($_POST['submit'])){

    $Staff_id=get_safe_value($_POST['Staff_id']);
    $Stall_id=get_safe_value($_POST['Stall_id']);


      $res=mysqli_query($con,"select * from tbl_allocation where Alloc_id='$Alloc_id'");
      $check=mysqli_num_rows($res);
      if ($check>0){
         // if(isset($_GET['Alloc_id']))
         // {
         //    $getData=mysqli_fetch_assoc($res);
         //    if ($Alloc_id==$getData['Alloc_id']){

         //    }
         //    else{
         //      $msg="ALREADY ALLOCATED";
         //    }
         // }
         if(isset($_GET['Alloc_id']))
         {
            $getData=mysqli_fetch_assoc($res);
            if ($Staff_id==$getData['Staff_id']){
              
            }
            else{
              $msg="ALREADY ALLOCATED";
            }
         }
         else{
          $msg="ALREADY ALLOCATED";

         }
       
              }
              if($Stall_id!=''){
    $sql="select * from tbl_allocation where Alloc_id='$Alloc_id'";
  }
  if($msg==''){
    //echo "insert into tbl_allocation(Staff_id,Stall_id) values('$Staff_id','$Stall_id')";
    if(isset($_GET['Alloc_id'])){
        $sql="update tbl_allocation set Staff_id='$Staff_id',Stall_id='$Stall_id' where Alloc_id='$Alloc_id'";
        mysqli_query($con,$sql) or die(mysqli_error($con)); 
        }

    else{
      
      $sql = "insert into tbl_allocation(Staff_id,Stall_id) values('$Staff_id','$Stall_id')";
            mysqli_query($con,$sql) ;
            if (!$sql) {
              $msg="ALREADY ALLOCATED";
               
             } 
            
        
        //mysqli_query($con,"insert into tbl_allocation(Staff_id,Stall_id,Item_name,Item_price,Item_qty) values('$Staff_id','$Item_name','$Item_price','$Item_qty')");
    }
    redirect('allocation.php');  
  }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Allocation</strong></div>
                        <form method="post" enctype="multipart/form-data">
                          <div class="card-body card-block">
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">STAFF</label>
                            <select class="form-control" name="Staff_id">
                              <option>Select STAFF</option>
                              <?php 
                                   $res=mysqli_query($con,"select Staff_id,Staff_name from tbl_staff order by Staff_name asc");
                      if(!$res)
                      {
                      echo "error".mysqli_error($con);
                      }
                      while($row=mysqli_fetch_assoc($res)){
                      if($row['Staff_id']==$Staff_id){
                        echo "<option selected value=".$row['Staff_id'].">".$row['Staff_name']."</option>";
                      }else{
                        echo "<option value=".$row['Staff_id'].">".$row['Staff_name']."</option>";
                      }
                      
                      } 
                      ?>


                            </select>
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">STALL</label>
                            <select class="form-control" name="Stall_id">
                              <option>Select Stall</option>
                              <?php 
                                   $res=mysqli_query($con,"select Stall_id,Stall_name from tbl_stall order by Stall_name");
                                   if(!$res)
                                    {
                                      echo "error".mysqli_error($con);
                                      }
                                  while($row=mysqli_fetch_assoc($res)){
                                if($row['Stall_id']==$Stall_id){
                                echo "<option selected value=".$row['Stall_id'].">".$row['Stall_name']."</option>";
                                }else{
                              echo "<option value=".$row['Stall_id'].">".$row['Stall_name']."</option>";
                              }
                             } 
                            ?>
                                ?>
                            </select>
                          </div>
                          

                    
                          <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <div class="field_error"><?php echo $msg?></div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<?php
require('footer.php');
?>