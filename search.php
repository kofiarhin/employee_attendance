<?php 


	require_once "header.php";


	$timesheet = new Timesheet;

	$start = Input::get("start_date");
	$end = Input::get("end_date");


	$search  = $timesheet->search($start, $end);

	var_dump($search);


 ?>


<div class="container">
	

	<div class="row justify-content-center">
		
			<div class="col-md-10">

			<table class="table">
				
				<thead>
					<tr>
						<td>Date</td>
						<td>Name</td>
						<td>Time In</td>
						<td>Time Out</td>
						<td>Total Hours</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>


			</table>

			</div>

	</div>


</div>