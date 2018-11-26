<?php 

require_once "header.php";

?>

<section id="admin_dashboard">



	<?php 



	if(session::exist(config::get('session/session_name')) && session::get(config::get('session/session_name'))  == "admin") {


		?>


		<div class="container">


			<h1 class="title text-center">Admin Dashboard!</h1>


			<div class="row">


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


					<i class="fa fa-calendar"></i>
					
					<p class="lead"><a href="announcements.php">Timesheet</a></p>
				</div>


				<div class="col-md-3 admin-unit">


					<i class="fa fa-dollar"></i>
					
					<p class="lead"><a href="announcements.php">Reimbursements</a></p>
				</div>


			</div>


		</div>


		<?php 


	}


	?>



</section>