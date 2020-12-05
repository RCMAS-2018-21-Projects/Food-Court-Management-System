<?php
include('top.php');

 if(!isset($_SESSION['USER_LOGIN'])){
header("location:./login_reg.php");
}


$query="select tbl_staff.*, tbl_login.* from tbl_staff,tbl_login where tbl_login.Username='$Username' and tbl_staff.Staff_id='$s_id'";
$query_run=mysqli_query($con,$query);
while($row=mysqli_fetch_array($query_run)){
 $Username=$row['Username']; 
 $Password=$row['Password'];                                        
if(isset($_POST['submit'])){

    $Staff_name=get_safe_value($_POST['Staff_name']);
    $Staff_hname=get_safe_value($_POST['Staff_hname']);
    $Street_name=get_safe_value($_POST['Street_name']);
    $Staff_city=get_safe_value($_POST['Staff_city']);
    $Staff_pin=get_safe_value($_POST['Staff_pin']);
    $Staff_phone=get_safe_value($_POST['Staff_phone']);
    // $Password=get_safe_value($_POST['Password']);
    
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
// if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
// $errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
// }


    if(count($errors)==0){
        // if(isset($_GET['Staff_id']) && $_GET['Staff_id']!=''){
        $q="update tbl_staff set Staff_name='$Staff_name',Staff_hname='$Staff_hname',Staff_city='$Staff_city',Staff_pin='$Staff_pin',Street_name='$Street_name',Staff_phone='$Staff_phone' where Staff_id='$s_id'";
        echo $q;
        mysqli_query($con,$q);
                    // mysqli_query($con,"update tbl_staff set Staff_name='$Staff_name',Staff_hname='$Staff_hname',Staff_city='$Staff_city',Staff_pin='$Staff_pin',Street_name='$Street_name',Staff_phone='$Staff_phone' where Staff_id='$s_id'");
            
        // }
        echo " ".mysqli_error($con);
        header('location:my-account.php');
        die();
    }}
    if (isset($_POST['submit1']))
    {
        $Password=get_safe_value($_POST['Password']);
        $Password1=get_safe_value($_POST['Password1']);
        if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0)
        {
        $errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
        }
        if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password1) == 0)
        {
        $errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
        }
        if($Password!=$Password1)
        {
        $errors['pass'] = '* Password not matching';
        echo'<script>alert("Password missmatch");</script>';
        }
        if(count($errors)==0){
        // if(isset($_GET['Staff_id']) && $_GET['Staff_id']!=''){
        $q="update tbl_login set Password='$Password' where Username='$Username'";
        echo $q;
        mysqli_query($con,$q);
                    // mysqli_query($con,"update tbl_staff set Staff_name='$Staff_name',Staff_hname='$Staff_hname',Staff_city='$Staff_city',Staff_pin='$Staff_pin',Street_name='$Street_name',Staff_phone='$Staff_phone' where Staff_id='$s_id'");
            
        // }
        echo " ".mysqli_error($con);
        header('location:my-account.php');
        die();
    }
    

    }
?>
                                    




        <!-- my account start -->
        <div class="myaccount-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="ml-auto mr-auto col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span></span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Profile </a></h5>
                                    </div>
                                    <div id="my-account-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <form method="POST">
                                            <div class="billing-information-wrapper">                                                
                                                <div class="row">

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Username</label>
                                                            <input type="email" type="email" id="Username" name="Username" placeholder="Enter Username" class="form-control" readonly required value="<?php echo $row['Username']?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Name</label>
                                                            <input type="text" id="Staff_name" name="Staff_name" placeholder="Enter Staff Name" class="form-control" required value="<?php echo $row['Staff_name']?>">
                                                            <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Phone Number</label>
                                                            <input type="text" maxlength="10" id="Staff_phone" name="Staff_phone" placeholder="Enter Mobile Number" class="form-control" required value="<?php echo $row['Staff_phone']?>">
                                                             <p><?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>House Name</label>
                                                            <input type="text" id="Staff_hname" name="Staff_hname" placeholder="House name" class="form-control" required value="<?php echo $row['Staff_hname']?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Street Name</label>
                                                            <input type="text" id="Street_name" name="Street_name" placeholder="Enter Street" class="form-control" required value="<?php echo $row['Street_name']?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>City</label>
                                                            <input type="text" id="Staff_city" name="Staff_city" placeholder="Enter City" class="form-control" required value="<?php echo $row['Staff_city']?>">
                                                            <p><?php if(isset($errors['p']))echo $errors['p']; ?></p>
                                                        </div>
                                                    </div>
                                                
                                           
                                                <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Pincode</label>
                                                            <input type="text" maxlength="6" id="Staff_pin" name="Staff_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $row['Staff_pin']?>">
                                                             <p><?php if(isset($errors['p']))echo $errors['p']; ?></p>
                                                        </div>
                                                </div>

                                                </div>
                                                <input type="text" name="Password" hidden>
                                                <div class="billing-back-btn">
                                                   <!--  <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div> -->
                                                    <div class="billing-btn">
                                                        <button name="submit" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                             
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span></span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                                    </div>
                                    <div id="my-account-2" class="panel-collapse collapse">
                                        <form method="POST">
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <div class="account-info-wrapper">
                                                    <!-- <h4>Change Password</h4>
                                                    <h5>Your Password</h5> -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Password</label>
                                                            <input type="password" id="Password" name="Password" placeholder="Enter Password" class="form-control" required value="<?php echo $row['Password']?>">
                                                             <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Password Confirm</label>
                                                            <input type="password" id="Password" name="Password1" placeholder="Enter Password" class="form-control">
                                                             <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <!-- <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div> -->

                                                    <div class="billing-btn">
                                                        <button name="submit1" type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                          <?php } ?> 
                            </div>
                        </div></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        

		<!-- all js here -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
<?php
include('footer.php')
?>
