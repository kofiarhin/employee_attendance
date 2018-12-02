<?php 


require_once "header.php";

		//regular in house keeping

if(!$user->logged_in()) {

	Redirect::to("login.php");
}

$timesheet = new Timesheet;

$timesheet_id = Input::get("timesheet_id");


		//generate the select option time range

$start = new DateTime();
$start->setTime(8, 0, 0);



$end = clone $start;
$end->setTime(18, 0, 0);


$interval = new DateInterval("PT1H");

$date_range  = new DatePeriod($start, $interval, $end);




?>


<div class="container">


	<h1 class="title text-center">Edit Timecard</h1>

	<div class="row justify-content-center">

		<div class="col-md-5">

			<?php 

				if(Input::exist('post', 'save_submit')) {

						$fields = array(

							'time_in' => input::get("time_in"),
							'time_out' => input::get('time_out')
						);

						$update = $timesheet->update_timecard($timesheet_id, $fields);


						if(!$update) {


							?>


		<p class="alert alert-danger text-center">There was a problem updating timesheet. Contact the Administrator!</p>
							<?php 
						} else {


							Redirect::to("employee_timesheet.php");
						}



				}


			 ?>

			<form action="" method="post">


				<div class="form-group">

					<label for="time_in">Time In</label>
					<select name="time_in" class="form-control">

						<?php foreach($date_range as $date): ?>

							<option value="<?php echo $date->format("H:i") ?>"><?php echo $date->format("H:i"); ?></option>

						<?php endforeach; ?>
					</select>
				</div>


				<div class="form-group">
					
					<label for="time_in">Time Out</label>
					<select name="time_out" class="form-control">
						
						<?php foreach($date_range as $date): ?>

							<option value="<?php echo $date->format("H:i") ?>"><?php echo $date->format("H:i"); ?></option>
							
						<?php endforeach; ?>
					</select>
				</div>



				

				
				<button class="btn btn-primary" name="save_submit" type="submit">Save Changes</button>

			</form>
		</div>

	</div>



</div>
