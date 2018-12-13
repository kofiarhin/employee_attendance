<?php 

	require_once "header.php";


	$user_id = Input::get('user_id');


	$leave = new Leave();

	$datas = $leave->get_all_user_leave($user_id);




 ?>


 <div class="container">
 	

 	<h1 class="title text-center">Request History!</h1>
		
		<div class="row justify-content-center">
			
				<div class="col-md-8">
			<?php 


								if(!$datas) {


									?>

		<p class="alert alert-info text-center">You are yet to put in a request</p>

									<?php 
								} else {


										///var_dump($datas[0]);


									?>


		<table class="table">
			
		<thead>
			<tr>
				<th>Request Date</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>


		<tbody>
			

			<?php 

					foreach($datas as $data) {

						$request_id = $data->request_id;
						$created_on  = $data->created_on;
						$start_date = $data->start_date;
						$end_date = $data->end_date;
						$status = $data->leave_status_name;

						?>

			<tr>
				
				<td><?php echo Helper::date_format($created_on); ?></td>
				<td><?php echo Helper::date_format($start_date); ?></td>
				<td><?php echo Helper::date_format($end_date); ?></td>
				<td><?php echo $status; ?></td>
				<td><a href="view_leave_request.php?id=<?php echo $request_id ?>">View</a></td>
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