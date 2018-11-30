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


								$stamp_out = $timesheet->stamp_out($user_id, $current_time);

								if($stamp_out) {

									Session::flash("success", "you have successfully stamped out!");

									Redirect::to("employee_dashboard.php");
								} else {

									?>
							

							<p class="alert alert-danger">There was a problem Stamping out!</p>



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


										<button class="btn btn-primary" type="submit" name="start_submit">Start Work!</button>

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

					$user_data = $timesheet->get_hours_worked($user_id, $current_date);

					


				?>
			
			<h1 class="title text-center">Total Hours for Today</h1>


				<?php 
		}


 ?>

