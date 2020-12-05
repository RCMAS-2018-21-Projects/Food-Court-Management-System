<?php
//session_start();
include ("header.php");
$errors=array();
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
    $res=mysqli_query($con,"select * from tbl_cust where Cust_id='$Cust_id'");
    $check=mysqli_num_rows($res);

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
    $res=mysqli_query($con,"select * from tbl_cust where Cust_name='$Cust_name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($Cust_id==$getData['Cust_id']){
            
            }else{
                $msg=" already exist";
            }
        }else{
            $msg="already exist";
        }
    }


if(!preg_match('/^[a-z ]+$/i', $Cust_name))
$errors['n'] = '* Invalid Name. Only alphabetic characters are allowed ';

if(!preg_match('/^[a-z ]+$/i', $Cust_city))
$errors['c'] = '* Invalid city. Only alphabetic characters are allowed ';

if(!(is_numeric($Cust_phone))){
       $errors['ph']="* invalid phone number";
  }
if (strlen($Cust_phone) < 10 || strlen($phno) > 10) {
        $errors['ph']="* invalid phone number";
     } 
if(!(is_numeric($Cust_pin))){
 $errors['p']="* invalid pincode. Only digit are allowed"; 
}
if (strlen($Cust_pin) < 6 || strlen($Cust_pin) > 6) {
        $errors['p']="* invalid pincode number";
     }
if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
$errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
}
    
    if($msg==''&& count($errors)==0){
                //echo "insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','staff')";
                //echo "insert into tbl_cust(Username,Cust_name,Cust_hname,Cust_city,Cust_pin,Street_name,Cust_phone) values('$Username','$Cust_name','$Cust_hname','$Cust_city','$Cust_pin','$Street_name','$Cust_phone')";
           $r1=mysqli_query($con,"insert into tbl_login (Username,Password,User_type) values ('$Username','$Password','customer')");
            $r2=mysqli_query($con,"insert into tbl_cust(Username,Cust_name,Cust_hname,Cust_city,Cust_pin,Street_name,Cust_phone) values('$Username','$Cust_name','$Cust_hname','$Cust_city','$Cust_pin','$Street_name','$Cust_phone')");
            if($r1)
            {
                if($r2)
                {
                   header('location:login_register.php');  
                }
                else
                {
                   echo " sql error".mysqli_error($con); 
                   die();
                }
            }
            else{
                echo " sql error".mysqli_error($con);
                die();
            }
        
        
       
        
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
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a  data-toggle="tab" href="login_register.php">
                                    <h4> login </h4>
                                </a>
                                <a class="active" href="reg.php">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    
                                        <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post" id="frmRegister">
                                                <input type="text" name="Cust_name" id="Cust_name" placeholder="Name" required>
                                                <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
                                                <input name="Username" id="Username" placeholder="Email" type="email" required>
                                                
                                                <div id="email_error" class="error_field"></div>
                                                <input type="password" name="Password" id="Password" placeholder="Password" required>
                                                 <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                                <input type="text" name="Cust_hname" id="Cust_hname" placeholder="House Name"  required>
                                                <input type="text" name="Street_name" id="Street_name" placeholder="Street"  required>
                                                <input type="text" name="Cust_city" id="Cust_city" placeholder="City"  required>
                                                <input type="text" name="Cust_pin" id="Cust_pin" placeholder="Pincode"  required>
                                                 <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
                                                <input type="text" name="Cust_phone" id="Cust_phone" placeholder="Phone"  required>
                                                 <p> <?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
                                                <!--<div class="button-box">
                                                    <button type="submit" >Register</button>
                                                </div>-->
                                                <div class="mt-3">
                                                      <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Register"  name="submit">
                                                        </div>
                                               <!-- <input type="hidden" name="type" value="register"/>-->
                                                <div id="form_msg" class="success_field"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                        
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
include("footer.php");
?>