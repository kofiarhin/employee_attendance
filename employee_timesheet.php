<?php 


require_once "header.php";



$user = new User;
$timesheet = new Timesheet;

if(!$user->logged_in()) {

	Redirect::to("login.php");
}


$user_id = session::get('user');
$date = date("Y-m-d");


$name = "";
$profile_pic = "default.jpg";

if($user->exist()) {

	$name = $user->data()->first_name.' '.$user->data()->last_name;
	$profile_pic = $user->data()->profile_pic;

}


//echo $profile_pic;


?>


<?php 


if(Input::exist('post', 'stampin_submit')) {


	$user_id = session::get('user');
	$time_in = date("H:i:s");


	$fields = array(

		'user_id' => (int) $user_id, 
		'time_in' => $time_in,
		'created_on' => date("Y-m-d")

	);




	$timesheet = new Timesheet();


	$stamp_in = $timesheet->stamp_in($fields);


}



if(Input::exist("post", "stampout_submit")) {

	$time_out = date("H:i:s");
	$id = Input::get("timesheet_id");
	
	$stampout = $timesheet->stamp_out($id, $time_out);

	if($stampout) {

		Redirect::to("employee_timesheet.php");
	}


}



?>

<div class="container">


	<div class="row">
		
		<div class="col-md-3 offset-md-2">1q3tgrdfgcb

			<div class="profile-face" style="background-image: url(img/<?php echo $profile_pic; ?>)">
				
			</div>
		</div>
		<div class="col-md-4">

			<div class="content-wrapper">


				<?php 


				if($timesheet->completed()) {


							//show hours worked;


					$hours_worked = $timesheet->get_hours_worked($user_id, $date);

					$unit = "";
					if($hours_worked) {

						$unit = ($hours_worked > 1 ) ?  "hours" : "hour";

						?>

						<h1 class="title">Awosome You Worked <?php echo $hours_worked ?> <?php echo $unit; ?> Today!</h1>

						<?php  
					}else {

						?>


						<h1 class="title">You did not meet minimum working hours!</h1>

						<?php 
					}


				} else {



					?>


					<h1 class="title text-center">

						<?php 


						$check = $timesheet->check($user_id, $date);

						if($check) {


							echo "Done With For the Day?";


						} else {


							echo "Ready For Work?";
						}

						?>


					</h1>


					<form action=""  method='post'>

						<?php 

								//check if user has already stamped


						$check  = $timesheet->check($user_id, $date);


						if($check) {


							?>

							<Input type="hidden" name="timesheet_id" value="<?php echo $check; ?>">

							<button class="btn btn-danger" type="submit" name="stampout_submit">Stamp Out!</button>
							<?php 
						} else {


							?>

							<button class="btn btn-primary" type="submit" name="stampin_submit">Stamp IN</button>

							<?php 
						}

						?>



					</form>


					<?php 

				}

				?>



			</div>
		</div>

	</div>


	




</div>