<?php
session_start();
include ("header.php");

$utype='';
$Username='';
$msg="";
$User_type='';
$u1="admin";
$u2="staff";
$u3="customer";
if(isset($_POST['submit'])){
    $Username=get_safe_value($_POST['Username']);
    $Password=get_safe_value($_POST['Password']);
   
    
    $sql="select * from tbl_login where Username='$Username' and Password='$Password' ";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
    $row=mysqli_fetch_assoc($res);
    $User_type=$row['User_type'];

    if($count>0){
 
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_NAME']=$Username;

    echo "valid".$_SESSION['USER_NAME'];
    }
    else{
    // echo "wrong";
    }
  
    //admin
    if($count>0 && $User_type==$u1 )
      { 
        $_SESSION['IS_LOGIN']=$fetch['Username'];
        header("location:./admin/index.php"); 
      }
    //staff  
      else if($count>0 && $User_type==$u2)
    {
        $_SESSION['IS_LOGIN']=$Username;
        
        header("location:./staff/index.php");
    }
    //customer
        else if($count>0 && $User_type==$u3)
    {
       $_SESSION['IS_LOGIN']=$Username;
       echo $_SESSION['IS_LOGIN'];
       // $_SESSION['Cust_id']=$Username;
        header("location:./customer/shop.php");
    }
       
        
    else {
        
        echo "<script>";
        echo "alert('Invalid Account')";
        echo "</script>";
        $msg="Please enter valid login details";
    }
}

?>
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="reg.php">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post" id="frmLogin">
                                                <input type="email" name="Username" placeholder="Enter Email" required>
                                                <input type="password" name="Password" placeholder="Enter Password" required>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <!-- <a href="<?php echo FRONT_SITE_PATH?>forgot_password">Forgot Password?</a> -->
                                                    </div>
                                                    <div class="container-login100-form-btn">
                                                    <!-- <button  name="submit" align="center" class="login100-form-btn">
                                                        Login
                                                     </button>
                                                    </div>-->
                                                    <div class="mt-3">
                                                      <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN" name="submit"/>
                                                        </div>
                                                    <!--<button type="submit" id="login_submit">Login</button>-->
													<input type="hidden" name="type" value="login"/>
													<input type="hidden" name="is_checkout" id="is_checkout" value=""/>
												   <div id="form_login_msg" class="success_field"></div>
                                                </div>
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
        
<?php
include("footer.php");
?>