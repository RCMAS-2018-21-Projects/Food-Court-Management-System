<?php 
include('top.php');
// include('footer.php');
$result = mysqli_query($con,"SELECT COUNT(*) AS `count` FROM `tbl_cust`");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
 $result = mysqli_query($con,"SELECT COUNT(*) AS `count1` FROM `tbl_staff`");
$row1 = mysqli_fetch_assoc($result);
$count1 = $row1['count1'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count2` FROM `tbl_stall`");
$row2 = mysqli_fetch_assoc($result);
$count2 = $row2['count2'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count3` FROM `tbl_item`");
$row3 = mysqli_fetch_assoc($result);
$count3 = $row3['count3'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count4` FROM `tbl_cat`");
$row4 = mysqli_fetch_assoc($result);
$count4 = $row4['count4'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count5` FROM `tbl_subcat`");
$row5 = mysqli_fetch_assoc($result);
$count5 = $row5['count5'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count6` FROM `tbl_order_master`");
$row6 = mysqli_fetch_assoc($result);
$count6 = $row6['count6'];

?>
 <!--  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" /> -->


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
   <!--  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->
    <!-- <link href="file:///C|/wamp64/www/Football Club/admin/assets/css/pe-icon-7-stroke.css" rel="stylesheet" /> -->
<!--   <div class="card">
            <div class="card-body"> -->
              <h1 class="grid_title">Dashboard </h1>
                  <style >
    .my-card
{

    position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%;
}
</style>
 <!--    <style type="text/css">
        img {
  width: 200px;
  height: 400px;
  object-fit: cover;
}
 </style> -->
         <div class="jumbotron"  >
<div class="row w-100"  >
        <div class="col-md-3"  >
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span  class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Customers</h4></div>
                <div class="text-danger text-center mt-3"><h1><?php echo $count;
                ?></h1></div>
            </div>
        </div>
        <div class="col-md-3" >
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Staff</h4></div>
                <div class="text-danger text-center mt-3" ><h1><?php echo $count1;
                ?></h1></div>
            </div>
        </div>
        <div class="col-md-3" >
            <div class="card border-danger mx-sm-1 p-3">
                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Stalls</h4></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $count2;
                ?></h1></div>
            </div>
        </div>
        <div class="col-md-3">
           <div class="card border-danger mx-sm-1 p-3">
                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Food Items</h4></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $count3;
                ?></h1></div>
            </div> 
       <br>
     </div>
    <div class="col-md-3">
           <div class="card border-danger mx-sm-1 p-3">
                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Categories</h4></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $count4;
                ?></h1></div>
            </div> 
       
     </div>
             <div class="col-md-3">
           <div class="card border-danger mx-sm-1 p-3">
                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Subcategories</h4></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $count5;
                ?></h1></div>
            </div> 
       
     </div>

     <div class="col-md-3">
           <div class="card border-danger mx-sm-1 p-3">
                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Total Orders</h4></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $count6;
                ?></h1></div>
            </div> 
       
     </div>

<!-- </div>
</div> -->
	
              
         </div>
     </div>
     <?php 
// include('top.php');
include('footer.php');
              ?>