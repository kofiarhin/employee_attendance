<?php 


require_once "header.php";

$timesheet = new Timesheet;


//generating fake data;

//$faker = Faker\Factory::Create();

/*
foreach(range(1, 30) as $x) {

	$month = 11;
	$user_id = 23;


	$date_range = $faker->dateTimeInInterval("november");

	$fields = array(

		'user_id' => $user_id,
		'time_in' => '8:00',
		'time_out' => '17:00',
		'created_on' => '2018-'.$month.'-'.$x,
		'completed' => 1,
		"approved" => 1

 	);


	db::get_instance()->insert("timesheet", $fields);



	

}



*/






if($user->has_permission("admin")) {


	$datas = $timesheet->get_all_user_timesheet();


}

?>


<div class="container">
	

	<h1 class="title">View All User Timesheet</h1>




	<form action="" method="post" class="form-inline" id="search-form">



		<div class="form-group mr-sm-4">
			<label for="from" class='mr-sm-2'>From</label>
			<input type="date" class="form-control" name="start_date" id="start">
			
			
		</div>

		<div class="form-group mr-sm-4">
			

			<label for="to" class="mr-sm-2">To</label>

			<input type="date" class="form-control" name="end_date" id="end">
			
		</div>

		<div class="form-group">
			
			<button class="btn btn-primary" type="submit" name="search_submit" id="search">Search</buton>
		</div>


	</form>


	<?php 

	if($datas) {



		?>


		<table class="table" id="result">
			
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

				<?php foreach($datas as $data) : ?>


					<?php 

					$total_hours= Helper::total_hours($data->time_in, $data->time_out);

					$approved = $data->approved;

					?>
					<tr class="<?php if($approved) { echo "table-success";} else { echo "table-danger";} ?>">
						
						<td><?php echo $data->created_on;?></td>
						<td><?php echo ucfirst($data->first_name. " ".$data->last_name);?></td>
						<td><?php echo $data->time_in;?></td>
						<td><?php echo $data->time_out;?></td>
						<td><?php echo $total_hours?></td>
						<td><a href="admin_view_timecard.php">View</a></td>
					</tr>
				<?php endforeach; ?>


			</tbody>

		</table>

		<?php 

	} else {


		?>

		<p class="alert alert-warning"> No Data in Timesheet!</p>

		<?php 
	}


	?>
	
</div>
