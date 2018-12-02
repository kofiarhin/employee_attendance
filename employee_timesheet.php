<?php 

require_once "header.php";


if(!$user->logged_in()) {


	Redirec::to("login.php");
}


$user_id = $user->data()->id;

$timesheet = new Timesheet;





?>


<div class="container">
	
	

	<?php 

	if(!$timesheet->exist()) {

		

		?>

		<p class="alert alert-info">You are yet to Put in Work!</p>


		<?php 


	} else {


		$datas = $timesheet->data();



		?>

		<h1 class="title text-center">Your Timesheet</h1>

		
		<div class="row justify-content-center">
			
			
			<div class="col-md-10">
				
				<table class="table">
					
					<thead>
						
						<tr>
							
							<th class="text-center">Date</th>
							<th class="text-center">Time In</th>
							<th class="text-center">Time Out</th>
							<th class="text-center">Total Hours</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>

					<tbody>
						

						<?php 

						foreach($datas as $data) {


							$timesheet_id = $data->id;


							$time_in = new Datetime($data->time_in);

							$time_out = new DateTime($data->time_out);


							$difference = $time_in->diff($time_out);

							$total_hours = $difference->h;

							?>

							<tr>
								
								<td class="text-center"><?php echo $data->created_on; ?></td>
								<td class="text-center"><?php echo $data->time_in; ?></td>
								<td class="text-center"><?php echo $data->time_out; ?></td>
								<td class="text-center"><?php echo $total_hours; ?></td>
								<td class="text-center"><a href="view_timecard.php?timesheet_id=<?php echo $timesheet_id; ?>" class="btn btn-sm btn-primary">View</a></td>
							</tr>

							<?php 
						}



						?>


					</tbody>


				</table>
			</div>


		</div>


		<?php 


		
	}



	?>


</div>

