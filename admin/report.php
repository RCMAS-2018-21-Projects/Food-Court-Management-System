<?php 
include('top.php');



?>

              <h1 class="grid_title">Reports </h1>
                  <style >
    .my-card
{

    position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%;
}
</style>
<!--     <style type="text/css">
        img {
  width: 200px;
  height: 400px;
  object-fit: cover;
}
 </style> -->
         <div class="jumbotron"  >
<div class="row w-100"  >
        <div class="col-md-3"  >

          <a href="pro_rep.php">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span  class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>Item Report</h4></div>
                
            </div></a>
        </div>
        <div class="col-md-3" >
          <a href="cust_rep.php?all=1">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Customer Report</h4></div>
                
            </div>
          </a>
        </div>
        <div class="col-md-3" >
          <a href="sales.php?all=1">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Sales Report</h4></div>
                
            </div>
          </a>
        </div>

                <div class="col-md-3" >
          <a href="stall_rep.php?all=1">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Stall Report</h4></div>
                
            </div>
          </a>
          <br>
        </div>
                <div class="col-md-3" >
          <a href="orderrep.php?all=1">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Order</h4></div>
                
            </div>
          </a>
        </div>
        <div class="col-md-3" >
          <a href="payrep.php?all=1">
            <div class="card border-danger mx-sm-1 p-3">

                <div class="" ><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3" ><h4>Payment</h4></div>
                
            </div>
          </a>
        </div>






<!-- </div>
</div> -->
	
              
         </div>
     </div>
     <?php 
// include('top.php');
include('footer.php');
              ?>