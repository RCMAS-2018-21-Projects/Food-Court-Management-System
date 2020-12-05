<?php
include('header.php');

 if(!isset($_SESSION['USER_LOGIN'])){
header("location:./login_reg.php");
}


$query="select tbl_cust.*, tbl_login.* from tbl_cust,tbl_login where tbl_login.Username='$Username' and tbl_cust.Cust_id='$c_id'";
$query_run=mysqli_query($con,$query);
while($row=mysqli_fetch_array($query_run)){
 $Username=$row['Username']; 
 $Password=$row['Password'];                                        
if(isset($_POST['submit'])){

    $Cust_name=get_safe_value($_POST['Cust_name']);
    $Cust_hname=get_safe_value($_POST['Cust_hname']);
    $Street_name=get_safe_value($_POST['Street_name']);
    $Cust_city=get_safe_value($_POST['Cust_city']);
    $Cust_pin=get_safe_value($_POST['Cust_pin']);
    $Cust_phone=get_safe_value($_POST['Cust_phone']);
    // $Password=get_safe_value($_POST['Password']);
    
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
// if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
// $errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
// }


    if(count($errors)==0){
        // if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
        $q="update tbl_Cust set Cust_name='$Cust_name',Cust_hname='$Cust_hname',Cust_city='$Cust_city',Cust_pin='$Cust_pin',Street_name='$Street_name',Cust_phone='$Cust_phone' where Cust_id='$c_id'";
        echo $q;
        mysqli_query($con,$q);
                    // mysqli_query($con,"update tbl_Cust set Cust_name='$Cust_name',Cust_hname='$Cust_hname',Cust_city='$Cust_city',Cust_pin='$Cust_pin',Street_name='$Street_name',Cust_phone='$Cust_phone' where Cust_id='$c_id'");
            
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
        // if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
        $q="update tbl_login set Password='$Password' where Username='$Username'";
        echo $q;
        mysqli_query($con,$q);
                    // mysqli_query($con,"update tbl_Cust set Cust_name='$Cust_name',Cust_hname='$Cust_hname',Cust_city='$Cust_city',Cust_pin='$Cust_pin',Street_name='$Street_name',Cust_phone='$Cust_phone' where Cust_id='$c_id'");
            
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
                                                            <input type="text" id="Cust_name" name="Cust_name" placeholder="Enter Cust Name" class="form-control" required value="<?php echo $row['Cust_name']?>">
                                                            <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Phone Number</label>
                                                            <input type="text" maxlength="10" id="Cust_phone" name="Cust_phone" placeholder="Enter Mobile Number" class="form-control" required value="<?php echo $row['Cust_phone']?>">
                                                             <p><?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>House Name</label>
                                                            <input type="text" id="Cust_hname" name="Cust_hname" placeholder="House name" class="form-control" required value="<?php echo $row['Cust_hname']?>">
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
                                                            <input type="text" id="Cust_city" name="Cust_city" placeholder="Enter City" class="form-control" required value="<?php echo $row['Cust_city']?>">
                                                            <p><?php if(isset($errors['p']))echo $errors['p']; ?></p>
                                                        </div>
                                                    </div>
                                                
                                           
                                                <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Pincode</label>
                                                            <input type="text" maxlength="6" id="Cust_pin" name="Cust_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $row['Cust_pin']?>">
                                                             <p><?php if(isset($errors['p']))echo $errors['p']; ?></p>
                                                        </div>
                                                </div>

                                                </div>
                                                <input type="text" name="Password" hidden>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>
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
                                                    <h4>Change Password</h4>
                                                    <h5>Your Password</h5>
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
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>

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
