<?php
include('top.php');
$Cat_id='';
$Subcat_id='';
$Item_price='';
$Item_name='';
$Item_id='';
$Desc='';
$Stall_id='';
$Item_image='';

 $msg='';

if(isset($_GET['Item_id']) && $_GET['Item_id']!=''){
    $Item_id=get_safe_value($_GET['Item_id']);
    $res=mysqli_query($con,"select * from tbl_item where Item_id='$Item_id'");
    $row=mysqli_fetch_assoc($res);
    $Item_name=$row['Item_name'];
    $Cat_id=$row['Cat_id'];
    $Subcat_id=$row['Subcat_id'];
    $Item_image=$row['Item_image'];
    $Item_price=$row['Item_price'];
    $Desc=$row['Desc'];  
    $Stall_id=$row['Stall_id'];  
}

if(isset($_POST['submit'])){

    $Cat_id=get_safe_value($_POST['Cat_id']);
    $Subcat_id=get_safe_value($_POST['Subcat_id']);
    $Item_price=get_safe_value($_POST['Item_price']);
    $Item_name=get_safe_value($_POST['Item_name']);

    $Desc=get_safe_value($_POST['Desc']);
    $Stall_id = get_safe_value($_POST['Stall_id']);
    $Item_image=$_FILES["Item_image"]["name"];

      $res=mysqli_query($con,"select * from tbl_item where Item_name='$Item_name'");
      $check=mysqli_num_rows($res);
      if ($check>0){
         if(isset($_GET['Item_id'])){
            $getData=mysqli_fetch_assoc($res);
            if ($Item_id==$getData['Item_id']){

            }
            else{
              $msg="Item ALREADY EXISTS";
            }
         }
      else
        {

            $msg = "ITEM ALREADY EXISTS";
        }
         }
              

  if($msg==''){
    if(isset($_GET['Item_id'])){
     
        $sql="UPDATE `tbl_item` SET `Cat_id`='$Cat_id',`Stall_id`='$Stall_id',`Subcat_id`='$Subcat_id',`Item_name`='$Item_name',`Item_price`='$Item_price',`Item_image`='$Item_image',`Desc`='$Desc' WHERE Item_id='$Item_id'";

        mysqli_query($con,$sql) or die(mysqli_error($con)); 
        if($sql){
            move_uploaded_file($_FILES["Item_image"]["tmp_name"],"upload/".$_FILES["Item_image"]["name"]);
            echo "successfully added";
        }
          else{
            echo "not added";
          }
        
    }
    else{
      // $sql="INSERT INTO `tbl_item`(`Stall_id`,`Cat_id`, `Subcat_id`, `Item_name`, `Item_price`,`Item_image`, `Desc`.`Status`) VALUES ('$Stall_id','$Cat_id','$Subcat_id','$Item_name','$Item_price','$Item_image','$Desc','1')";
      $sql="INSERT INTO `tbl_item`( `Stall_id`, `Cat_id`, `Subcat_id`, `Item_name`, `Item_price`, `Item_image`, `Desc`, `Status`) VALUES ('$Stall_id','$Cat_id','$Subcat_id','$Item_name','$Item_price','$Item_image','$Desc','1')";
      echo $sql;
            mysqli_query($con,$sql) or die(mysqli_error($con)); 
            if($sql){
            move_uploaded_file($_FILES["Item_image"]["tmp_name"],"upload/".$_FILES["Item_image"]["name"]);
            echo "successfully added";
          }
          else{
            echo "not added";
          }

    }
    redirect('item.php');  
  }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Item</strong></div>
                        <form method="post" enctype="multipart/form-data">
                          <div class="card-body card-block">

                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Stall</label>
                            <select class="form-control" name="Stall_id">
                              <option>Select Stall</option>
                              <?php
                              $res=mysqli_query($con,"select Stall_id,Stall_name from tbl_stall order by Stall_name asc");
                              while($row=mysqli_fetch_assoc($res)){
                                if($row['Stall_id']==$Stall_id){
                                  echo "<option selected value=".$row['Stall_id'].">".$row['Stall_name']."</option>";
                                   }else{
                                  echo "<option value=".$row['Stall_id'].">".$row['Stall_name']."</option>";
                                  }               
                               }
                              ?>
                            </select>
                          </div>
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">Categories</label>
                            <select class="form-control" name="Cat_id">
                              <option>Select Category</option>
                              <?php
                    $res=mysqli_query($con,"select Cat_id,Cat_name from tbl_cat order by Cat_name asc");
                    while($row=mysqli_fetch_assoc($res)){
                      if($row['Cat_id']==$Cat_id){
                        echo "<option selected value=".$row['Cat_id'].">".$row['Cat_name']."</option>";
                      }else{
                        echo "<option value=".$row['Cat_id'].">".$row['Cat_name']."</option>";
                      }
                      
                    }
                    ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Subcategories</label>
                            <select class="form-control" name="Subcat_id">
                              <option>Select Subcat</option>
                              <?php
                    $res=mysqli_query($con,"select Subcat_id,Subcat_name from tbl_subcat order by Subcat_name asc");
                    if(!$res)
                    {
                      echo "error".mysqli_error($con);
                    }
                    while($row=mysqli_fetch_assoc($res)){
                      if($row['Subcat_id']==$Subcat_id){
                        echo "<option selected value=".$row['Subcat_id'].">".$row['Subcat_name']."</option>";
                      }else{
                        echo "<option value=".$row['Subcat_id'].">".$row['Subcat_name']."</option>";
                      }
                      
                    }
                    ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Name</label>
                            <input type="text" name="Item_name" required value="<?php echo $Item_name?>" placeholder="Enter Item Name" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Price</label>
                            <input type="text" name="Item_price" placeholder="Enter Item Price" required value="<?php echo $Item_price?>" class="form-control">
                          </div>

                         <div class="form-group">
                            <label for="categories" class=" form-control-label">Description</label>
                            <input type="text" name="Desc" placeholder="Enter Description" required value="<?php echo $Desc?>" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Image</label>
                            <input type="file" name="Item_image" placeholder="Enter Item Image" required value="<?php echo $Item_image?>" class="form-control">
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