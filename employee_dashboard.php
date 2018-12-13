<?php 

	require_once "header.php";


	if(!$user->logged_in()) {

		Redirect::to("login.php");
	}




 ?>


 <div class="container">


 	<h1 class="title text-center">Employee Dashboard!</h1>


 	<div class="row">


 		<div class="col-md-3 admin-unit">


 			<i class="fa fa-address-card"></i>
 			
 			<p class="lead"><a href="timecard.php">Stamp In/Out</a></p>
 		</div>



 		<div class="col-md-3 admin-unit">

 			<i class="fa fa-calendar"></i>
 			<p class="lead"><a href="employee_timesheet.php">Timesheet</a></p>

 		</div>



		
		<div class="col-md-3 admin-unit">

			<i class="fa fa-envelope"></i>
			<p class="lead"><a href="leave_application.php">Leave Application</a></p>

		</div>



 		<div class="col-md-3 admin-unit">


 			<i class="fa fa-dollar"></i>
 			
 			<p class="lead"><a href="employee_view_reimbursement.php">Reimbursements</a></p>
 		</div>


 		<div class="col-md-3 admin-unit">


 			<i class="fa fa-dollar"></i>
 			
 			<p class="lead"><a href="employee_view_reimbursement.php">Wallet</a></p>
 		</div>


 	</div>


 </div>
