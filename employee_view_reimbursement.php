<?php 

require_once "header.php";

	//general house keeping

if(!$user->logged_in()) {


	Redirect::to("login.php");
}


$user_id = $user->data()->id;

$reimbursement = new Reimbursement;

$datas = $reimbursement->get_user_reimbursement($user_id);


if(!$datas) {

	Session::flash("error", "Data does not exist in database!");

	Redirect::to("employee_dashboard.php");
}


?>


<div class="container">


	<h1 class="title text-center">View Reimbursement!</h1>

	<div class="button-wrapper">

		<a href="create_reimbursement.php" class="btn btn-primary">Create Reimbursement!</a>

	</div>


	<div class="row justify-content-center">

		<div class="col-md-8">


			<table class="table table-hover table-bordered">

				<thead>

					<tr>
						<td>Created On</td>
						<td>Description</td>
						<td>Amount</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>

				<tbody>

				<?php 

						foreach($datas as $data) {


							$created_on = $data->created_on;
							$description = $data->description;
							$amount  = $data->amount;
							$status = $data->rem_name;

							?>

							<tr>
								<td><?php echo Helper::date_format($created_on); ?></td>
								<td><?php echo $description; ?></td>
								<td><?php echo $amount; ?></td>
								<td><?php echo $status; ?></td>
								<td><a href="">Delete</a></td>
							</tr>


							<?php 
						}

				 ?>
					
				</tbody>


			</table>
		</div>


	</div>



</div>