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


 			<i class="fa fa-stamp"></i>
 			
 			<p class="lead"><a href="employee_timesheet.php">Stamp In/Out</a></p>
 		</div>



 		<div class="col-md-3 admin-unit">

 			<i class="fa fa-user"></i>
 			<p class="lead"><a href="register.php">Register Employee</a></p>

 		</div>


 		<div class="col-md-3 admin-unit">
 			
 				<i class="fa fa-users"></i>
 				<p class="lead"><a href="employees.php">Employees</a></p>

 		</div>


 		<div class="col-md-3 admin-unit">


 			<i class="fa fa-bullhorn"></i>
 			
 			<p class="lead"><a href="announcements.php">Announcements</a></p>
 		</div>


 		


 		<div class="col-md-3 admin-unit">


 			<i class="fa fa-dollar"></i>
 			
 			<p class="lead"><a href="announcements.php">Reimbursements</a></p>
 		</div>


 	</div>


 </div>
