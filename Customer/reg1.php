<?php
//session_start();
include ("header.php");
   $name='';
   $hname='';
   //$hno='';
   $street='';
   $city='';
  // $District='';
   //$state='';
   $pincode='';
   $phno='';
   $email='';
   $password='';
   //$passcon='';
function email_validation($str) { 
    return (!preg_match( 
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) 
        ? FALSE : TRUE; 
}

function special_chars($string){
    return preg_match('/^[A-Z][a-zA-Z -]+$/', $string);
}
if(isset($_GET['Cust_id']) && $_GET['Cust_id']!=''){
    $Cust_id=get_safe_value($_GET['Cust_id']);
    $res=mysqli_query($con,"select * from tbl_cust where Cust_id='$Cust_id'");
    $check=mysqli_num_rows($res);

    }
  //create connection
   //  $con= mysqli_connect("localhost","root","","shop");

  if(isset($_POST['submit'])){
 
  //values passed from form
   $name=get_safe_value($_GET['name']);
   $hname=get_safe_value($_GET['hname']);
  //$hno=$_GET['hno'];
  // $street=$_GET['street'];
   $city=get_safe_value($_GET['city']);
   //$District=$_GET['District'];
   //$state=$_GET['state'];
   $pincode=get_safe_value($_GET['pincode']);
   $phno=get_safe_value($_GET['phno']);
   $email=get_safe_value($_GET['email']);
   $password=get_safe_value($_GET['password']);
   //$passcon=$_POST['conpass'];
   
$errors=array();

$c="select * from tbl_login where Username='$email'";
$rs=mysqli_query($con,$c);

if(empty($name)){
  $errors['n']="* Name required";
}
if(!preg_match('/^[a-z ]+$/i', $name))
$errors['n'] = '* Invalid Name. Only alphabetic characters are allowed ';

if (preg_match('~[0-9]+~', $name)) {
  $errors['n']="* invalid name. Only alphabetic characters are allowed ";
}
if(empty($hname)){
  $errors['h']="* House name required";
}
if(!preg_match('/^[a-z ]+$/i', $hname))
$errors['h'] = '* Invalid house Name. Only alphabetic characters are allowed ';
if(empty($hno)){
  $errors['j']="* House No  required";
}
if(empty($street)){
  $errors['s']="* street name required";
}
if(empty($city)){
  $errors['c']="* city required";
}
if(!preg_match('/^[a-z ]+$/i', $city)){
  $errors['c']="* Invalid city name.Only alphabetic characters are allowed";
}
//if(empty($District)){
  //$errors['d']="* District required";
//}
//if(!preg_match('/^[a-z ]+$/i', $District))
//$errors['d'] = '* Invalid District.Only alphabetic characters are allowed ';

//if (preg_match('~[0-9]+~', $District)) {
  //$errors['d']="* invalid District. Only alphabetic characters are allowed ";
//}
//if(empty($state)){
  //$errors['st']="* state required. Only alphabetic characters are allowed ";
//}

//if(!preg_match('/^[a-z ]+$/i', $state))
//$errors['st'] = '* Invalid State. Only alphabetic characters are allowed ';

//if (preg_match('~[0-9]+~', $state)) {
//  $errors['st']="* invalid state. Only alphabetic characters are allowed ";
//}

if(empty($pincode)){
  $errors['p']="* pincode required";
}
if(!(is_numeric($pincode))){
 $errors['p']="* invalid pincode. Only digit are allowed"; 
}
if (strlen($pincode) < 6 || strlen($pincode) > 6) {
        $errors['p']="* invalid pincode number";
     }
if(empty($phno)){
  $errors['p']="* phone number required";
}
if(special_chars($phno)){
  $errors['ph']="* Invalid phone number";
}
 if(!(is_numeric($phno))){
       $errors['ph']="* invalid phone number";
  }
  if (strlen($phno) < 10 || strlen($phno) > 10) {
        $errors['ph']="* invalid phone number";
     } 
if(empty($email)){
  $errors['e']="* email required";
}else if(mysqli_num_rows($rs)>0){
  $errors['e']="* email exists";
}
if(!email_validation($email)) { 
     $errors['e']="* Invalid email address"; 
}
if(empty($password)){
  $ez="* password required";
}

if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) == 0){
$ez = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
}

if(empty( $passcon)){
  $errors['cps']="* confirm password";
}
//if($password!=$passcon){
 // $ez="* password doesn't match";
//}

if(count($errors)==0){

 

  $sql1 = "insert into tbl_Cust( Username,Cust_name,Cust_hname,Street_name,Cust_city,Cust_pincode,Cust_phno) Values('$email','$name','$hname','$street','$city','$District','$state','$pincode','$phno')";
            

  $sql2 = "insert into tbl_login(Username,Password,User_type) values('$email','$password','customer')";

            $rslt1= mysqli_query($con,$sql1);
            if(!$rslt1)
            {
              echo "error".mysqli_error($con);
              die();
            }

            $rslt2 = mysqli_query($con,$sql2);
            if(!$rslt2)
            {
              echo "error".mysqli_error($con);
              die();
            }

              $_SESSION['Username']=$email;
              
                  header("location:index.php");
            
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
                                            <form method="POST" id="frmRegister">
                                                <input type="text" name="name" id="Cust_name" placeholder="Name" required>
                                                <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
                                                <input name="email" id="Username" placeholder="Email" type="email" required>
                                                
                                                <div id="email_error" class="error_field"></div>
                                                <input type="password" name="password" id="Password" placeholder="Password" required>
                                                 <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                                <input type="text" name="hname" id="Cust_hname" placeholder="House Name"  required>
                                                <input type="text" name="street" id="Street_name" placeholder="Street"  required>
                                                <input type="text" name="city" id="Cust_city" placeholder="City"  required>
                                                <input type="text" name="pincode" id="Cust_pin" placeholder="Pincode"  required>
                                                 <p> <?php //if(isset($errors['p']))echo $errors['p']; ?></p>
                                                <input type="text" name="phno" id="Cust_phone" placeholder="Phone"  required>
                                                 <p> <?php //if(isset($errors['ph']))echo $errors['ph']; ?></p>
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