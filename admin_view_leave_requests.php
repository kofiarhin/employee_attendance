<?php 

	
	require_once "header.php";

	if(!$user->logged_in()) {


		Redirect::to("login.php");
	}


	$leave = new Leave;

	$datas = $leave->get_all_leave_request();






 ?>


 <div class="container">
 	
			<h1 class="title text-center">Leave Requests!</h1>


	<div class="row">
		
	
		<div class="col-md-12">

			<?php 


				if(!$datas) {




					?>

	<p class="alert alert-info text-center">There are no requests yet!</p>

					<?php 
				} else {

				//var_dump($datas[0]);

					?>



	<table class="table">
		

		<thead>
			
			<tr>
				<th>Requests Date</th>
				<th>Full Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Number of Days</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>


		<tbody>
			
				<?php 

					foreach($datas as $data) {

						$created_on = Helper::date_format($data->request_date);

						$start_date = Helper::date_format($data->start_date);
						$end_date = Helper::date_format($data->end_date);

						$full_name = $data->first_name." ".$data->last_name;

						$num_days = Helper::date_diff($start_date, $end_date);

						$leave_status_name = $data->leave_status_name;

						$request_id = $data->request_id;


						?>


			<tr>
				
				<td><?php echo $created_on; ?></td>
				<td class="text-capitalize"><?php echo $full_name; ?></td>
				<td><?php echo $start_date; ?></td>
				<td><?php echo $end_date; ?></td>
				<td><?php echo $num_days; ?></td>
				<td><?php echo $leave_status_name; ?></td>
				<td><a href="admin_view_leave_request.php?id=<?php echo $request_id; ?>">View</a></td>
			</tr>

						<?php 


					}

				 ?>

		</tbody>

	</table>

					<?php 
				}

			 ?>



		</div>


	</div>

 </div>