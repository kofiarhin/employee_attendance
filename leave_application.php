<?php 

require_once "header.php";

$user_id = $user->data()->id;

?>


<div class="container">


	<h1 class="title text-center">Leave Application Dashboard</h1>


	<div class="row justify-content-center">

		<div class="col-md-3 text-center">

			<a href="create_leave_request.php">
				<i class="fa fa-plus"></i>
				<p class="sub-title text-center">Create</p>

			</a>

		</div>

		<div class="col-md-3 text-center">

			<a href="employee_leave_requests.php?user_id=<?php echo $user_id; ?>">
				<i class="fa fa-eye"></i>
				<p class="sub-title text-center">View all</p>

			</a>

		</div>


	





	</div>


</div>