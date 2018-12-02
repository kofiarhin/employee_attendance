<?php 


require_once "header.php";


		//regular in house keeping


if(!$user->logged_in()) {

	Redirect::to("login.php");
}


$timesheet_id = Input::get("timesheet_id");


if(!$timesheet_id) {

	Session::flash("error", "Timecard does not exist");
	Redirect::to("route.php");
}


$timesheet =  new Timesheet();


$data = $timesheet->get_timesheet($timesheet_id);

		//var_dump($data);




?>


<div class="container">

	<h1 class="title text-center">Timecard For The Day</h1>


	<?php 

			if(Input::exist("post", "approve_submit")) {



				$approve = $timesheet->approve($timesheet_id);

				if($approve) {

					Redirect::to("employee_timesheet.php");
				}
			}

	 ?>


	<?php 

	if($data) {


		$time_in = new Datetime($data->time_in);
		$time_out= new Datetime($data->time_out);

		$difference = $time_in->diff($time_out);

		$total_hours = $difference->h;

		$approved = $data->approved;

							//echo $total_hours;


		?>

		<table class="table">
			
			<thead>
				
				<tr>
					<td>Date</td>
					<td>Time In</td>
					<td>Time Out</td>
					<td>Total Hours</td>
					<td>Status</td>
				</tr>
			</thead>


			<tbody>
				

				<tr>
					
					<td><?php echo $data->created_on; ?></td>
					<td><?php echo $data->time_in; ?></td>
					<td><?php echo $data->time_out; ?></td>
					<td><?php echo $total_hours; ?></td>
					<td><?php if($approved == 0 ) { 


						?><a href="edit_timecard.php?timesheet_id=<?php echo $timesheet_id; ?>">Edit</a><?php 

					} else {


						?>
		
							<a href="delete_timecard.php?timesheet_id=<?php echo $timesheet_id; ?>" class="btn btn-danger">Delete</a>

						<?php 

				} ?></td>
				</tr>
			</tbody>



		</table>



		<?php 

			if($approved == 0) {


				?>
		
			<div class="button-wrapper">
				
				<form action="" method="post">
					
					<button class="btn btn-primary" type="submit" name="approve_submit">Approve</button>
				</form>
			</div>


				<?php 
			}

	}

	?>



</div>


