<?php
ob_start();
require('top.php');
$Cust_id='';
$Cust_name='';
$Cust_hname='';
$Cust_city='';
$Street_name='';
$Cust_pin='';
$Cust_phone='';
$Cust_dob='';
$Username='';
$Password='';
$msg='';
if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
    $Cust_id=get_safe_value($_GET['Cust_id']);
    $Username=get_safe_value($_GET['Username']);
    $res=mysqli_query($con,"select tbl_cust.*,tbl_login.* from tbl_cust,tbl_login where tbl_login.Username='$Username' and tbl_cust.Username='$Username'");
    $check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
        $Cust_name=$row['Cust_name'];
        $Cust_hname=$row['Cust_hname'];
        $Street_name=$row['Street_name'];
        $Cust_city=$row['Cust_city'];
        $Cust_pin=$row['Cust_pin'];
        $Cust_phone=$row['Cust_phone'];
        $Password=$row['Password'];
		$Username=$row['Username'];
	}else{
		header('location:customer.php');
		die();
	}
}

if(isset($_POST['submit'])){
    $Cust_name=get_safe_value($_POST['Cust_name']);
    $Cust_hname=get_safe_value($_POST['Cust_hname']);
    $Street_name=get_safe_value($_POST['Street_name']);
    $Cust_city=get_safe_value($_POST['Cust_city']);
    $Cust_pin=get_safe_value($_POST['Cust_pin']);
    $Cust_phone=get_safe_value($_POST['Cust_phone']);
    
	$Username=get_safe_value($_POST['Username']);
	$Password=get_safe_value($_POST['Password']);
	$res=mysqli_query($con,"select * from tbl_Cust where Cust_name='$Cust_name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($Cust_id==$getData['Cust_id']){
			
			}else{
				$msg="Cust already exist";
			}
		}else{
			$msg="Cust already exist";
		}
	}
	if(!preg_match('/^[a-z ]+$/i', $Cust_name))
$errors['n'] = '* Invalid Name. Only alphabetic characters are allowed ';

if(!preg_match('/^[a-z ]+$/i', $Cust_city))
$errors['c'] = '* Invalid city. Only alphabetic characters are allowed ';

if(!(is_numeric($Cust_phone))){
       $errors['ph']="* invalid phone number";
  }
if (strlen($Cust_phone) < 10 || strlen($Cust_phone) > 10) {
        $errors['ph']="* invalid phone number";
     } 
if(!(is_numeric($Cust_pin))){
 $errors['p']="* invalid Phone no. Only digit are allowed"; 
}
if (strlen($Cust_pin) < 6 || strlen($Cust_pin) > 6) {
        $errors['p']="* invalid pincode number";
     }
if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
$errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
}



	if($msg==''&& count($errors)==0){
		if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
			mysqli_query($con,"update tbl_Cust set Cust_name='$Cust_name',Cust_hname='$Cust_hname',Cust_city='$Cust_city',Cust_pin='$Cust_pin',Street_name='$Street_name',Cust_phone='$Cust_phone',Cust_dob='$Cust_dob' where Cust_id='$Cust_id'");
		}else{
				//echo "insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','Cust')";
				//echo "insert into tbl_Cust(Username,Cust_name,Cust_hname,Cust_city,Cust_pin,Street_name,Cust_phone,Cust_dob) values('$Username','$Cust_name','$Cust_hname','$Cust_city','$Cust_pin','$Street_name','$Cust_phone','$Cust_dob')";
			mysqli_query($con,"insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','Cust')");
			mysqli_query($con,"insert into tbl_Cust(Username,Cust_name,Cust_hname,Cust_city,Cust_pin,Street_name,Cust_phone,Cust_dob) values('$Username','$Cust_name','$Cust_hname','$Cust_city','$Cust_pin','$Street_name','$Cust_phone','$Cust_dob')");
		}
		echo " ".mysqli_error($con);
		header('location:customer.php');
		die();
	}
}
?>

<!-- <script type="text/javascript">
   
    function check()
    { var letters=/^[a-z A-Z]+$/;
    var numbers=/^[0-9]+$/;
        if(!document.getElementById("Cust_name").value.match(letters))
        {
            alert('Please input alphabet characters only,enter  name');
            return false;
        }
       else if(!document.getElementById("Cust_city").value.match(letters))
        {
              
            alert('Please input alphabet characters only,enter  city');
            return false;
        }
        else if(!document.getElementById("Cust_phone").value.match(numbers))
        {
            alert('Please input numeric characters only,enter phone number');
            return false;
        }
        else if(document.getElementById("Cust_phone").value.length<10)
        {
            alert('invalid Phone number,enter phone number');
            return false;
        }
    else if(!document.getElementById("Cust_pin").value.match(numbers))
        {
            alert('Please input numeric characters only,enter pin number');
            return false;
        }
        else if(document.getElementById("Cust_pin").value.length<6)
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
                        <div class="card-header"><strong>Manage Cust</strong></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="Cust" class=" form-control-label">Name</label>
									<input type="text" id="Cust_name" name="Cust_name" placeholder="Enter Cust Name" class="form-control" required value="<?php echo $Cust_name?>">
                                    <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
								</div>
                                <div class="form-group">
									<label for="Cust" class=" form-control-label">Username</label>
									<input type="email" id="Username" name="Username" placeholder="Enter Username" class="form-control" required value="<?php echo $Username?>">
								</div>
                                <div class="form-group">
									<label for="Cust" class=" form-control-label">Password</label>
									<input type="text" id="Password" name="Password" placeholder="Enter Password" class="form-control" required value="<?php echo $Password?>">
                                    <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
								</div>
							   <div class="form-group">
									<label for="Cust" class=" form-control-label">House name</label>
									<input type="text" id="Cust_hname" name="Cust_hname" placeholder="House name" class="form-control" required value="<?php echo $Cust_hname?>">
								</div>

                                <div class="form-group">
									<label for="Cust" class=" form-control-label">Street name</label>
									<input type="text" id="Street_name" name="Street_name" placeholder="Enter Street" class="form-control" required value="<?php echo $Street_name?>">
								</div>
								 <div class="form-group">
									<label for="Cust" class=" form-control-label">City</label>
									<input type="text" id="Cust_city" name="Cust_city" placeholder="Enter City" class="form-control" required value="<?php echo $Cust_city?>">
                                     <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>
								 <div class="form-group">
									<label for="Cust" class=" form-control-label">Pincode</label>
									<input type="text" maxlength="6" id="Cust_pin" name="Cust_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $Cust_pin?>">
                                    <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>								
                                <div class="form-group">
									<label for="Cust" class=" form-control-label">Mobile Number</label>
									<input type="text" maxlength="10" id="Cust_phone" name="Cust_phone" placeholder="Enter Mobile Number" class="form-control" required value="<?php echo $Cust_phone?>">
                                     <p> <?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
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