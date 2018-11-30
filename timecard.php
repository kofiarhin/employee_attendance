<?php 


require_once "header.php";

use Carbon\Carbon;


if(!$user->logged_in()) {

	Redirect::to("login.php");
}


if(!$user->exist()) {


	Session::flash("error", "Account does not exist. Contact Administrator!");
}

$timesheet = new Timesheet;



$user_id = $user->data()->id;

$current_date = date("Y-m-d");
$current_time = date("H:i:s");



//if completed timesheet


?>


<?php 


if(!$timesheet->completed()) {


	//var_dump($timesheet);

	?>



	<div class="caontainer">

		<?php 

		$message = ($timesheet->check($user_id, $current_date)) ? "Had a great day?" : "Ready For Work?";









		?>

		<h1 class="title text-center"><?php echo $message; ?></h1>

		<div class="row justify-content-center">

			<div class="col-md-4">`


				<?php 


							//stamp user in


				if(Input::exist("post", "start_submit")) {


					$time_in = date("H:i:s");

					$fields = array(

						"user_id" => $user_id,
						"time_in" => $time_in,
						"created_on" => date("Y-m-d H:i:s"),
						"completed" => 0

					);


					$start = $timesheet->stamp_in($fields);

					if($start) {

						Session::flash("success", "You have successfully stamped In!");


						Redirect::to("employee_dashboard.php");
					} else {

						?>


						<p class="alert alert-danger">There was a problem creating time card. Contact the Administrator!</p>


						<?php 
					}
				}


				//stamp user out


				if(input::exist("post", "end_submit")) {


					$current_date = date("Y-m-d");

					$stamp_out = $timesheet->stamp_out($user_id, $current_time, $current_date);

					if($stamp_out) {


						Session::flash("success", "You successfully stamped out");

						Redirect::to("employee_dashboard.php");
					} else {


						?>

			<p class="alert alert-danger">There was a problem stamping out. Contact Administrator!</p>

						<?php 
					}
 


				}

				?>

				<form action="" method="post">

					<div class="button-wrapper">


						<?php 

						if($timesheet->check($user_id, $current_date)) {

							?>

							<button class="btn btn-danger" type="submit" name="end_submit">End Work!</button>
							<?php 
						} else {


							?>


							<button class="btn btn-warning" type="submit" name="start_submit">Start Work!</button>

							<?php 
						}

						?>


					</div>



				</form>

			</div>




		</div>


	</div>



	<?php

} else {	






					//$date = Carbon::now();

	$total_hours = $timesheet->get_hours_worked($user_id, $current_date);




	?>


	<h1 class="title text-center">Total Hours for Today <?php echo $total_hours; ?></h1>


	<?php 
}


?>

<div class="button-wrapper">

	<a href="employee_timesheet.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary text-center" >View timesheet!</a>

</div>
