<?php 

require_once "header.php";


	//basic login checks

if(!$user->logged_in()) {

	redirect::to("login.php");
}


$user_id  = Input::get("user_id");


if(!$user_id) {

	Session::flash("error", "User Does not Exist in Database");

	Redirect::to("route.php");
}




$timesheet = new Timesheet($user_id);





?>



<div class="container">


	<?php 


	if(!$timesheet->exist()) {

		?>
		<p class="alert alert-info text-center">Yet to put in the Work!</p>

		<?php 
	} else {

		?>
		
		<table class="table">
			

			<thead>
				<tr>
					<th>Date</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>Total Hours</th>
					<th>Action</th>
				</tr>
			</thead>


			<tbody>
				
				<?php 

							$datas = $timesheet->data();


							
								foreach($datas as $data) {


								$date = $data->created_on;

								$time_in = new Datetime($data->time_in);
								$time_out = new Datetime($data->time_out);

								$difference = $time_in->diff($time_out);





								$total_hours = $difference->h;

								?>

		<tr>
			
			<td><?php echo $date; ?></td>
			<td><?php echo $data->time_in; ?></td>
			<td><?php echo $data->time_out; ?></td>
			<td><?php echo $total_hours; ?></td>
			<td><a href="view_timecard.php">View</a></td>
		</tr>

									<?php 
							}


				 ?>
			</tbody>
		</table>


		<?php 

		if($user->has_permission("admin")) {



			?>

			<div class="button-wrapper">


				<a href="approve_all.php" class="btn btn-warning">Approve All</a>

			</div>

			<?php 
		}


}


	?>


	

	?>


</div>