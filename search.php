<?php 


require_once "core/init.php";





$timesheet = new Timesheet;

$start = Input::get("start_date");
$end = Input::get("end_date");


$search  = $timesheet->search($start, $end);





?>


<div class="container">
	

	<div class="row justify-content-center">
		
		<div class="col-md-10" id="#result">

			<table class="table">
				
				<thead>
					<tr>
						<td>Date</td>
						<td>Name</td>
						<td>Time In</td>
						<td>Time Out</td>
						<td>Total Hours</td>
						<td>Action</td>
					</tr>
				</thead>


				<tbody>
					
					<?php 

					if($search) {

						foreach($search as $data) {

							$full_name = $data->first_name." ".$data->last_name;

							$total_hours = Helper::total_hours($data->time_in, $data->time_out);

							?>

							<tr>

								<td><?php echo $data->created_on; ?></td>
								<td><?php echo $full_name; ?></td>
								<td><?php echo $data->time_in?></td>
								<td><?php echo $data->time_out?></td>
								<td><?php echo $total_hours;?></td>

								<td>View</td>
							</tr>

							<?php 
						}

					}
					?>

				</tbody>


			</table>

		</div>

	</div>


</div>