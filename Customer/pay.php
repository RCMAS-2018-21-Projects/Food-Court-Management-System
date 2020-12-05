
<?php
session_start();
include('database.inc.php');
$mg='';$name='';$rate='';

if(isset($_SESSION['IS_LOGIN']))
{
  $q=$_SESSION['IS_LOGIN'];


}
 else{
header("location:./login_register.php");

   }


$buy='s';
if(isset($_GET['id'])&&isset($_GET['qty'])){
  $id=$_GET['id'];
  $qty=$_GET['qty'];
  $st="select *from tbl_item where Item_id='$id'";
  $tr=mysqli_query($con,$st);
  if(!$tr)
  {
    echo "error".mysqli_error($con);
    die();
  }

          $er=mysqli_fetch_assoc($tr);
          $name=$er['Item_name']; 
          $rate=$er['Item_price']; 
       

}


   $msg='';


 if(isset($_POST['p-bt'])&&isset($_POST['tot']))
 {
 	$t=$_POST['tot'];
 
 	// $type=$_POST['type'];
  $ty=$_POST['ty'];
 	$number=$_POST['number'];
 	$name=$_POST['name'];
 	$n=$number;
 	$date=$_POST['date'];
 	$cvv=$_POST['cvv'];
 	 $len=strlen($n); 
 	 $length=$len-3;
 	 $d=0;
  

if($length==16){
   function validateCCExpDate($str)

  {
  	
     return preg_match("/(0[1-9]|1[0-2])\/20[0-9]{2}$/", $str);
  }
   $ExpDate =$_POST['date'];

   validateCCExpDate($ExpDate) ? $ms="true" : $ms="false";
   if($ms=='false')
 		{
 			$e1="invalid Date";
 		}
   if($ms=='true')
   {
   	$arr=explode("/",$ExpDate);
   	  $m=$arr[0];
   	  $y=$arr[1];

   	$year = date("Y");
   	$month = date("m");
   	if($m<=12 && $y>=$year)
   	{
        $d=1;
   	}
   else if($y==$year && $m<=$month)
   {
     $d=1;
   }
   else
   {
   	$a="invalid Date";
   }
   	
   }
   if($d==1){
   	$da=date("Y/m/d");
   	$s="select *from tbl_cust where Username='$q'";
   	$r=mysqli_query($con,$s);
   	$row=mysqli_fetch_assoc($r);
   	$cust_id=$row['Cust_id'];
   	$s1="insert into tbl_order_master(Cust_id,Order_date,tot_amt,Order_status)values('$cust_id','$da','$t','Null')";
    $r1=mysqli_query($con,$s1);


    $s3="select *from tbl_order_master where Cust_id='$cust_id' AND Order_status='NULL'";
   	$r3=mysqli_query($con,$s3);
    if(!$r3)
    {
      echo "error".mysqli_error($con);
      die();
    }
   
      
   	$row3=mysqli_fetch_assoc($r3);
   	$order_id=$row3['Morder_id'];
    $s2="select *from tbl_cart where Cust_id='$cust_id'";
    $r2=mysqli_query($con,$s2);

    if(!$r2){
    mysqli_error($con);
    die();
     }

     while($row2=mysqli_fetch_assoc($r2))
      {
    
      $a=$row2['Item_id'];
      $b=$row2['qty'];


     $sql="insert into tbl_order_child(Morder_id,Item_id,Quantity)values('$order_id','$a','$b')";
      $op=mysqli_query($con,$sql);
      if(!$op)
      {
        Echo "error".mysqli_error($con);
        die();
      }

    

   }




   $exp="select *from tbl_cardc where Card_no='$number'";
    $rc=mysqli_query($con,$exp);
    $bn=mysqli_fetch_assoc($rc);
    if(mysqli_num_rows($rc)<=0)
  
    {

    // $s5="insert into tbl_cardc(Card_no,Cust_id,Card_name,Expiry,Card_type)values('$number','$cust_id','$name','$date','$ty')";
    $s5="insert into tbl_cardc(Cust_id,Card_name,Card_no,Expiry,Card_type)values('$cust_id','$name','$number','$date','$ty')";
  // echo $s5;
   mysqli_query($con,$s5);
  }
   //  if(!$vb)
   // {
   
   //    mysqli_error($con);
   //    die();
   //   }
    
  $s6="select *from tbl_cardc where Card_no='$n'";
    $r6=mysqli_query($con,$s6);
          if(!$r6){
    mysqli_error($con);
    
    die();
  }
     
     while($rt=mysqli_fetch_assoc($r6))

  $Card_no=$rt['Card_no'];



  $time=date("h:i:sa");
  $da=date("Y/m/d");
   	$s4="insert into tbl_pay(Morder_id,Card_no,P_type,P_status,P_date)values('$order_id','$number','card','successfull','$da')";
   	$po=mysqli_query($con,$s4);
          if(!$po)
      {
        Echo "error".mysqli_error($con);
        die();
      }
     else{
       header("location:success.php?a=$order_id");
     }


  	

}
 

 
	
 

 else{
 		$g="invalid number";
 		
 }
}






 // if(isset($_POST['card']))
 // {
 //   $gna=$_POST['gna'];
 //   $gno=$_POST['gno'];
 //   $ty=$_POST['ty'];
 //   $gda=$_POST['gda'];
 //   if($ty==0)
 //   {
 //    $t=0;
 //   }
 //   else
 //   {
 //    $t=1;
 //   }


}

   ?>
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/pay.css?v=<?php echo time();?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<style>
.address form table tr td{
	padding: 9px;
}
</style>
    

</head>
<body>
	
		<div class="pay-con ">
			<h1 class="hd">PAYMENT</h1>
<div class="con1">		
			
	<div >
		Products

    <frameset>    
    <iframe src="target.php?v=<?php echo time();?>" name="tar" width="100%" height="47%" scrolling="" frameborder="1"  style="background:#B0C4DE;">></iframe>
 
        </frameset>
	</div>
	<div class="total">
    <?php
          

              $srt="select *from tbl_cust where Username='$q'";
              $r=mysqli_query($con,$srt);
                if(!$r)
               {
                echo "error".mysqli_error($con);
                die();
               }
              $row=mysqli_fetch_assoc($r);
              $cus_id=$row['Cust_id'];
            
          
            $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.Item_id=tbl_item.Item_id AND tbl_cart.Cust_id='$cus_id'";
               $rez=mysqli_query($con,$S);
               if(!$rez)
               {
                echo "error".mysqli_error($con);
                die();
               }
               $c=0;$i=0;$tot=0;$s=0;
               if(mysqli_num_rows($rez)>0){
               while($e=mysqli_fetch_assoc($rez)){
                
                $cart_id=$e['Cart_id'];
                $qty=$e['qty']; 
                $i+=$qty;
                $price=$e['Item_price']; 
                $subtot=$qty*$price;
                $tot+=$subtot;
            
            ?>
              <?php }} ?>
                Total Amount:<h1><?PHP echo number_format($tot)." Rs";?></h1> 
        
                
	</div>

</div>
<div class="con2">
	<div class="address">


	</div>
	<div class="item3">
     <div class="form">
     	<form method="post">
     <div class="inl">
 
          <br><br>
         &nbsp; &nbsp;<input type="radio" name="ty" value="debit" required> &nbsp;&nbsp;<label>Debit</label>
         
         <input type="radio" name="ty" value="credit">&nbsp;&nbsp;<label>Credit</label>
   
      </div>
       
        <br><br>

        <img src="image/card1.png" width="30px">
        <img src="image/card2.png" width="30px">
        <img src="image/card3.png" width="30px">

       
       
    <div class="grp">
      
     
        Name on Card<input type="text" class="input" placeholder="Name on card" name='name' value="<?php if(isset($gna))echo $gna; ?>"  required>
       
     
  
     
        Card Number
      <!--   <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" name='number' required> --> 
         <input type="text" name="number" data-mask="0000 0000 0000 0000"  class="input" placeholder="Card Number" value="<?php if(isset($gno))echo $gno; ?>" required><br /><div style="color: red;font-size:14px;"><?php if(isset($g)){echo $g;}?></div>
  <!--   <img src="other.png" id="img" style="padding:5px;" /><br /> -->
      

        <?php 

?>
   

       <div class="cvv">
       
       <div class="cvv1">
            Expiry Date<input type="text"  class="input" data-mask="00/0000"  placeholder="00 / 0000" name='date' value="<?php if(isset($gda))echo $gda; ?>"  required>
              <div style="color: red;font-size:12px; "><?php if(isset($a)){ echo $a;}?>
                                          <?php if(isset($e1)){echo $e1;}?> </div> 
     <!--        <input type="month" id="start" name="date"
       min="2018-03" value="2018-05">  -->
        </div>  
      
        <div class="cvv1">  
            CVV<input type="password" class="input" data-mask="000" placeholder="000" name='cvv' required>
         </div>

       </div>
        </div>
         <div>
         	<!-- <input type="text" name="tot" value="<?PHP echo $rate?>" hidden> -->
          <input type="text" name="tot" value="<?PHP echo $tot?>" hidden>
       <button class="p-bt" type="submit" name="p-bt">Pay</button>
      </div>

  </form>
      </div>

         </div>
      </div> 
      
    </div>

	</div>
</div>
<div class="item3">

</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<?php



?>
</body>
</html>