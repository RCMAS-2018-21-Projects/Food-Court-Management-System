
<?php
session_start();
$con=mysqli_connect("localhost","root","","foodcourt");
if(isset($_SESSION['IS_LOGIN']))
{
$sql1 = "select * from tbl_cust where Username='".$_SESSION['IS_LOGIN']."'";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($res1);
$name=$row['Cust_name'];
$c_id=$row['Cust_id'];
}
   else{
header("location:login_register.php");

   }
   $it='';


   ?>
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	<link rel="stylesheet" type="text/css" href="pay.css?v=<?php echo time();?>">
</head>


<body>		
			

	
	
              
            <?php
            
            if($it=='')
            $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.item_id=tbl_item.Item_id AND tbl_cart.cust_id='$c_id'";
               $rez=mysqli_query($con,$S);
               if(!$rez)
               {
                echo "error".mysqli_error($con);
               }
               $c=0;$i=0;$tot=0;$s=0;
               if(mysqli_num_rows($rez)>0){
               while($e=mysqli_fetch_assoc($rez)){
                $s++;
                $pname=$e['Item_name'];
                $qty=$e['qty']; 
            
            ?>
           <h4><?php  echo $s.".&nbsp;".$pname."(".$qty.")" ;  ?></h4>

            <?php }}?>
           


</body>


</html>