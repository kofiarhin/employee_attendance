<?php 	

		require_once "header.php";



		$id = Input::get("id");


	
		$leave = new Leave($id);


		if(!$leave->exist()) {


			Redirect::to("route.php");
		}


		$data = $leave->data();


		var_dump($data);

		$created_on  = Helper::date_format($data->request_date);

		$start_date = Helper::date_format($data->start_date); 
		$end_date = Helper::date_format($data->end_date);
		$request_status_name = $data->request_status;
		$request_status  = $data->leave_status;






		$days  = Helper::date_diff($start_date, $end_date); 



 ?>


 <div class="container">

 	<h1 class="title text-center">View Leave Request!</h1>
 	
		
		<div class="row justify-content-center">
			
		<table class="table">
			
			<thead>
				<tr>
					<th>Request Date</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Num of Days</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo $created_on; ?></td>
					<td><?php echo $start_date; ?></td>
					<td><?php echo $end_date; ?></td>
					<td><?php echo $days; ?></td>
					<td><?php echo $request_status_name; ?></td>
					<td><?php if($request_status != 2) {
						?>

					<a href="edit_leave_request.php?id=<?php echo $id; ?>">Edit</a>

						<?php 
					} else {


						?>

						<a href="delete_leave_request.php?request_id=<?php echo $id; ?>">Delete</a>

						<?php 
					}


					?></td>
				</tr>
			</tbody>
		</table>

		</div>


 </div>