<?php
session_start();
include('database.inc.php');
if(isset($_SESSION['IS_LOGIN']))
{
$sql1 = "select * from tbl_cust where Username='".$_SESSION['IS_LOGIN']."'";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($res1);
$name=$row['Cust_name'];
$c_id=$row['Cust_id'];
}




if(isset($_GET['or']))
{
	$or=$_GET['or'];
}
else
{
	echo "error..... NOT FOUND";
}

  $sql="delete from tbl_cart where Cust_id='$c_id'";


$e=mysqli_query($con,$sql);
if(!$e)
{
  echo "error".mysqli_error($con);
}


$sq="select *from tbl_order_child where Morder_id='$or'";
$res=mysqli_query($con,$sq);
while($row=mysqli_fetch_assoc($res))

{
	$i=$row['Item_id'];
  $p=$row['Quantity'];
  $sqq="select *from tbl_item where Item_id='$i'";
  $ress=mysqli_query($con,$sqq);
	$rop=mysqli_fetch_assoc($ress);
  //  $l=$rop['Item_qty'];
  //  $k=$l-$p;
  //  $s="update tbl_item set Item_qty='$k' where Item_id='$i'";
  // $j=mysqli_query($con,$s);

}


  $s1="update tbl_order_master set Order_status='In process' where Morder_id='$or'";
    $r1=mysqli_query($con,$s1);
?>


<!DOCTYPE html>
<html>
<head>

	<title>success</title>
	<style type="text/css">
		
		.success-page{
  max-width:500px;
 
  margin: 0 auto;
  text-align: center;
      position: relative;
   
    transform: perspective(1px) translateY(50%);
    border:1px solid #000;
    padding: 10px;
}
.success-page img{
  max-width:62px;
  display: block;
  margin: 0 auto;
}

.btn-view-orders{
  display: block;
  border:1px solid #33c7c5;
  width:200px;
  margin: 0 auto;
  margin-top: 45px;
  padding: 10px;
  color:#fff;
  background-color:#aac7c5;
  text-decoration: none;
  margin-bottom: 20px;
}
h2{
  color:#47c7c5;
    margin-top: 25px;

}
a{
  text-decoration: none;
}
	</style>
</head>
<body>
<div class="success-page">
   <img  src="image/success.png" class="center" width="100px" />
  <h2>Ordered Successful !</h2>
  <p>We are delighted to inform you that we received your Order</p>
  <table style="margin-left:120px; ">
  	<tr>
  		<td>Order Id:</td>
  		<td><?php echo $or; ?></td>
  	</tr>
  
  </table>

  <hr><a href="shop.php" class="btn-view-orders">Continue Shopping</a>
  
</div>
</div>
</body>
</html>