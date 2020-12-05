
<?php
session_start();
include('database.inc.php');
$mg='';$name='';$rate='';

if(isset($_SESSION['IS_LOGIN']))
{
  $q=$_SESSION['IS_LOGIN'];


}
 else{
header("location:login_register.php");

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
    


     // $sql="insert into tbl_order_child(Morder_id,item_id,Quantity)values('$order_id','$id','$qty')";
     //  $op=mysqli_query($con,$sql);
     //  if(!$op)
     //  {
     //    Echo "error".mysqli_error($con);
     //    die();
     //  }

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
      $sql="insert into tbl_order_child(Morder_id,Item_id,Quantity) values('$order_id','$a','$b')";
      // echo $sql;
     $rt=mysqli_query($con,$sql);
        if(!$rt){
    mysqli_error($con);
    die();
     }
    }  

    $s4="insert into tbl_pay(Morder_id,Card_no,P_type,P_date,P_status)values('$order_id','0','Cash','$da','pending')";
    // echo $s4;
    mysqli_query($con,$s4);
       if(!$s4){
     echo "wegsdfgsdf".mysqli_error($con);
    die();
     }  


      header("location:load.php?a=$order_id&b=$payment_id&c=$del");
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
			<h1 class="hd">Confirm Order</h1>
<div class="con1">		
			
	<div >
		Products
    <frameset>
    <iframe src="target.php?v=<?php echo time();?>" name="tar" width="100%" height="47%" scrolling="" frameborder="1"  style="background:#B0C4DE;">></iframe>
  </frameset>


          <!-- <h1><?php echo $name."  qty:".$qty ?></h1> -->

	</div>
	<div class="total">

               <!--  Total Amount:<h1><?PHP echo number_format($rate*$qty)." Rs" ;$tot=$rate*$qty;?></h1> --> 
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
    <form method="post">
    <input type="text" name="tot" value="<?php echo $tot ?>" hidden>
<input type="submit" name="p-bt" value="Confirm"  style="background:skyblue;color:#fff;">
</form>
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