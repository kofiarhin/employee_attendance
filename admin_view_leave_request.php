<?php 


require_once "header.php";


	//general in house keeping

if(!$user->logged_in()) {

	Redirect::to("login.php");
}

if(!$user->has_permission("admin")) {

	Redirect::to("route.php");

}


$id = Input::get("id");

if(!$id) {

	Session::flash("error", "Datadoes not exist in Database");

	Redirect::to("route.php");
}


$leave = new Leave; 

$data = $leave->get_request($id);

if(!$data) {

	Session::flash("error", "Data does not exist in database");

	Redirect::to("route.php");

}

//var_dump($data);

$name = $data->first_name." ".$data->last_name;
$profile_pic = $data->profile_pic;
$leave_balance = $data->leave_days;
$request_date = Helper::date_format($data->request_date);
$start_date = Helper::date_format($data->start_date);
$end_date = Helper::date_format($data->end_date);
$num_of_days = Helper::date_diff($start_date, $end_date);
$user_id = $data->user_id;

$leave_status = $data->leave_status;

?>


<div class="container">


	<h1 class="title text-center">View Employee Request!</h1>

	<div class="row">

		<div class="col-md-3 offset-md-1">

			<div class="profile-face" style="background-image: url(img/<?php echo $profile_pic; ?>)">

			</div>

			<div class="text-content">
			
				<p class="text-capitalize">Name: <strong><?php echo $name; ?></strong></p>
				<p class="text">Leave Balance: <?php  echo $leave_balance;?> days</p>

			</div>

		</div>


		<div class="col-md-8">

			<?php 

					if(Input::exist('post', 'approve_submit')) {


			

						$num_of_days = Input::get("num_of_days");
						$request_id = Input::get('id');


						$approve = $leave->approve($user_id, $request_id, $num_of_days);


						if($approve) {


							Redirect::to("route.php");

						} else {

							?>

			<p class="alert alert-danger">There was a problem approving Request. check Database!</p>

							<?php 
						}

					}



					if(Input::exist('post', 'decline_submit')) {


						$request_id = Input::get("request_id");

						$decline = $leave->decline($request_id);

						if($decline) {

							Redirect::to("admin_view_leave_requests.php");
						} else {
							

							?>

		<p class="alert alert-danger">There was a problem declining employee request. Contact the Administrator!</p>
							<?php 
						}


					}


			 ?>

			<table class="table">

				<thead>
					<th>Date Requested</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Number of Days</th>
				</thead>

				<tbody>

					<tr class="<?php if($leave_status == 2) { echo "table-success";} ?>">
						<td><?php echo $request_date; ?></td>
						<td><?php echo $start_date; ?></td>
						<td><?php echo $end_date; ?></td>
						<td><?php echo $num_of_days; ?></td>
					</tr>


				</tbody>
			</table>

			<form action="" method="post">


				<!--====  hidden fields=======-->

				<input type="hidden" name="request_id" value="<?php echo $id; ?>">

				<input type="hidden" name="num_of_days" value="<?php echo $num_of_days; ?>">
				<input type="hidden" name="employee_id" value="<?php echo $user_id; ?>">
				<div class="button-wrapper">

						<?php 


								if($leave_status != 2) {

									?>

									<button class="btn btn-primary" type="submit" name="approve_submit">Approve</button>

									<button class="btn btn-danger" type="submit" name="decline_submit">Decline</button>

									<?php 
								} else {

									?>
	
					<a href="delete_leave_request.php?request_id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>

									<?php 
								}


						 ?>

				</div>

			</form>

		</div>


	</div>


</div>