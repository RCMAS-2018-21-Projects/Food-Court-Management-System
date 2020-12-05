<?php
ob_start();
require('top.php');
$Staff_id='';
$Staff_name='';
$Staff_hname='';
$Staff_city='';
$Street_name='';
$Staff_pin='';
$Staff_phone='';
$Staff_dob='';
$Username='';
$Password='';
$msg='';
if(isset($_GET['Staff_id']) && $_GET['Staff_id']!=''){
	$Staff_id=get_safe_value($_GET['Staff_id']);
	$res=mysqli_query($con,"select * from tbl_staff where Staff_id='$Staff_id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
        $Staff_name=$row['Staff_name'];
        $Staff_hname=$row['Staff_hname'];
        $Street_name=$row['Street_name'];
        $Staff_city=$row['Staff_city'];
        $Staff_pin=$row['Staff_pin'];
        $Staff_phone=$row['Staff_phone'];
        $Staff_dob=$row['Staff_dob'];
		$Username=$row['Username'];
	}else{
		header('location:staff.php');
		die();
	}
}

if(isset($_POST['submit'])){
    $Staff_name=get_safe_value($_POST['Staff_name']);
    $Staff_hname=get_safe_value($_POST['Staff_hname']);
    $Street_name=get_safe_value($_POST['Street_name']);
    $Staff_city=get_safe_value($_POST['Staff_city']);
    $Staff_pin=get_safe_value($_POST['Staff_pin']);
    $Staff_phone=get_safe_value($_POST['Staff_phone']);
    $Staff_dob=get_safe_value($_POST['Staff_dob']);
	$Username=get_safe_value($_POST['Username']);
	$Password=get_safe_value($_POST['Password']);
	$res=mysqli_query($con,"select * from tbl_staff where Staff_name='$Staff_name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['Staff_id']) && $_GET['Staff_id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($Staff_id==$getData['Staff_id']){
			
			}else{
				$msg="staff already exist";
			}
		}else{
			$msg="staff already exist";
		}
	}
	if(!preg_match('/^[a-z ]+$/i', $Staff_name))
$errors['n'] = '* Invalid Name. Only alphabetic characters are allowed ';

if(!preg_match('/^[a-z ]+$/i', $Staff_city))
$errors['c'] = '* Invalid city. Only alphabetic characters are allowed ';

if(!(is_numeric($Staff_phone))){
       $errors['ph']="* invalid phone number";
  }
if (strlen($Staff_phone) < 10 || strlen($Staff_phone) > 10) {
        $errors['ph']="* invalid phone number";
     } 
if(!(is_numeric($Staff_pin))){
 $errors['p']="* invalid Phone no. Only digit are allowed"; 
}
if (strlen($Staff_pin) < 6 || strlen($Staff_pin) > 6) {
        $errors['p']="* invalid pincode number";
     }
if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
$errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
}



	if($msg==''&& count($errors)==0){
		if(isset($_GET['Staff_id']) && $_GET['Staff_id']!=''){
			mysqli_query($con,"update tbl_staff set Staff_name='$Staff_name',Staff_hname='$Staff_hname',Staff_city='$Staff_city',Staff_pin='$Staff_pin',Street_name='$Street_name',Staff_phone='$Staff_phone',Staff_dob='$Staff_dob' where Staff_id='$Staff_id'");
		}else{
				//echo "insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','staff')";
				//echo "insert into tbl_staff(Username,Staff_name,Staff_hname,Staff_city,Staff_pin,Street_name,Staff_phone,Staff_dob) values('$Username','$Staff_name','$Staff_hname','$Staff_city','$Staff_pin','$Street_name','$Staff_phone','$Staff_dob')";
			mysqli_query($con,"insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','staff')");
			mysqli_query($con,"insert into tbl_staff(Username,Staff_name,Staff_hname,Staff_city,Staff_pin,Street_name,Staff_phone,Staff_dob) values('$Username','$Staff_name','$Staff_hname','$Staff_city','$Staff_pin','$Street_name','$Staff_phone','$Staff_dob')");
		}
		echo " ".mysqli_error($con);
		header('location:staff.php');
		die();
	}
}
?>

<!-- <script type="text/javascript">
   
    function check()
    { var letters=/^[a-z A-Z]+$/;
    var numbers=/^[0-9]+$/;
        if(!document.getElementById("Staff_name").value.match(letters))
        {
            alert('Please input alphabet characters only,enter  name');
            return false;
        }
       else if(!document.getElementById("Staff_city").value.match(letters))
        {
              
            alert('Please input alphabet characters only,enter  city');
            return false;
        }
        else if(!document.getElementById("Staff_phone").value.match(numbers))
        {
            alert('Please input numeric characters only,enter phone number');
            return false;
        }
        else if(document.getElementById("Staff_phone").value.length<10)
        {
            alert('invalid Phone number,enter phone number');
            return false;
        }
    else if(!document.getElementById("Staff_pin").value.match(numbers))
        {
            alert('Please input numeric characters only,enter pin number');
            return false;
        }
        else if(document.getElementById("Staff_pin").value.length<6)
        {
            alert('invalid pin number,enter pin number');
            return false;
        }
     else if(document.getElementById("Password").value.length<8)
        {
            alert('Enter password with minimum lebgth of 8 characters');
            return false;
        }
        else
        {
            return true;
        }
    }

   
</script> -->



<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Staff</strong></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="staff" class=" form-control-label">Name</label>
									<input type="text" id="Staff_name" name="Staff_name" placeholder="Enter Staff Name" class="form-control" required value="<?php echo $Staff_name?>">
                                    <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
								</div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Username</label>
									<input type="email" id="Username" name="Username" placeholder="Enter Username" class="form-control" required value="<?php echo $Username?>">
								</div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Password</label>
									<input type="text" id="Password" name="Password" placeholder="Enter Password" class="form-control" required value="<?php echo $Password?>">
                                    <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
								</div>
							   <div class="form-group">
									<label for="staff" class=" form-control-label">House name</label>
									<input type="text" id="Staff_hname" name="Staff_hname" placeholder="House name" class="form-control" required value="<?php echo $Staff_hname?>">
								</div>

                                <div class="form-group">
									<label for="staff" class=" form-control-label">Street name</label>
									<input type="text" id="Street_name" name="Street_name" placeholder="Enter Street" class="form-control" required value="<?php echo $Street_name?>">
								</div>
								 <div class="form-group">
									<label for="staff" class=" form-control-label">City</label>
									<input type="text" id="Staff_city" name="Staff_city" placeholder="Enter City" class="form-control" required value="<?php echo $Staff_city?>">
                                     <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>
								 <div class="form-group">
									<label for="staff" class=" form-control-label">Pincode</label>
									<input type="text" maxlength="6" id="Staff_pin" name="Staff_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $Staff_pin?>">
                                    <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>								
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Mobile Number</label>
									<input type="text" maxlength="10" id="Staff_phone" name="Staff_phone" placeholder="Enter Mobile Number" class="form-control" required value="<?php echo $Staff_phone?>">
                                     <p> <?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
								</div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Date of Birth</label>
									<input type="date" max="2001-12-31" id="Staff_dob" name="Staff_dob" placeholder="DOB" class="form-control" required value="<?php echo $Staff_dob?>">
								</div>								
							   <button id="payment-button" name="submit" onclick="check()" type="submit" class="btn btn-lg btn-info btn-block">
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

?>