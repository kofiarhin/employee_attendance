<?php 


require_once "header.php";

$timesheet = new Timesheet;



if($user->has_permission("admin")) {


		$datas = $timesheet->get_all_user_timesheet();


}

?>


<div class="container">
	

	<h1 class="title">View All User Timesheet</h1>


	<?php 

			if($datas) {



				?>


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
