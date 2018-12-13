<?php 

require_once "header.php";


	//general house keeping

if(!$user->logged_in()) {


	Redirect::to("login.php");
}




if(!$id = Input::get('id')) {


	Session::flash("error", "Data does not exist");

	Redirect::to("index.php");


}


$reimbursement = new Reimbursement($id);


/*

if(!$reimbursement->exist()) {


	Session::flash("error", "Sorry Data does not exist!");
	Redirect::to("index.php");
}

*/




$data = $reimbursement->data();




/*

if(!$data) {


	Session::flash("error", "Data does not exist in database!");


	Redirect::to("index.php");


}

*/

//var_dump($data);

$name  = $data->first_name. " ".$data->last_name;
$status = $data->rem_name;
$amount = $data->amount;
$rem_status_id = $data->rem_status_id;
$created_on = Helper::date_format( $data->rem_created_on);


?>


<div class="container">


	<h1 class="title text-center">View Request</h1>


	<div class="row justify-content-center">

		<div class="col-md-8">


			<?php 

			//check if admin has approved request

			if(Input::exist("post", "approve_submit")) {


				echo $id;

				$approve = $reimbursement->approve($id);

				if($approve) {


					Redirect::to("admin_view_reimbursement.php");
				}
			}



			//check if admin has declined request

			if(Input::exist('post','decline_submit')) {



					$decline = $reimbursement->decline($id);

					if(!$decline) {


						?>

			<p class="alert alert-danger">There was a problem updating Database. Check with the Administrator!</p>


						<?php  
					} else {


						Redirect::to("admin_view_reimbursement.php");
					}
  





			}



			?>


			<table class="table">
				
				<thead>
					
					<tr>
						<th>Date</th>
						<th>Name</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>

					<tr>

						<td><?php echo $created_on; ?></td>
						<td class="text-capitalize"><?php echo $name; ?></td>
						<td><?php echo $amount; ?></td>
						<td><?php echo $status; ?></td>

						<td><a href="delete_rem_request.php?rem_id=<?php echo $id; ?>">Delete</a></td>

					</tr>


				</tbody>
			</table>


			<form action="" method="post">
				
				<div class="button-wrapper">



					<?php 

					if($user->has_permission("admin")) {

						?>

						<form action="" method="post">


							<div class="button-wrapper">

								<?php 

								//if not approved show the approval button

								if($rem_status_id != 2) {

									?>

									<button class="btn btn-primary" type='submit' name="approve_submit">Approve!</button>



									<button class="btn btn-danger" name="decline_submit" type="submit">Decline</button>


									<?php 
								}


								?>


								<!--====  show the button when status is not declined or =======-->


								




							</div>

						</form>


						<?php 
					}


					?>


				</div>
			</form>

			

		</div>


	</div>


</div>