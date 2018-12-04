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

if(!$data) {


	Session::flash("error", "Data does not exist in database!");


	Redirect::to("index.php");


}

$crated_on = $data->rem_created_on;
$name = $data->first_name." ".$data->last_name;
$amount = $data->amount;

$status = ($data->approved == 0) ? "Pending" : "Approved";

?>


<div class="container">


	<h1 class="title text-center">View Request</h1>


	<div class="row justify-content-center">

		<div class="col-md-8">


			<?php 


				if(Input::exist("post", "approve_submit")) {

					$approve = $reimbursement->approve($id);

					if($approve) {


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

						<td>25th December</td>
						<td class="text-capitalize"><?php echo $name; ?></td>
						<td>500</td>
						<td><?php echo $status; ?></td>
						<td><a href="delete_rem_request.php?id=<?php echo $id; ?>">Decline</a></td>
					</tr>


				</tbody>
			</table>


			<form action="" method="post">
				
				<div class="button-wrapper">
					
					<?php if($user->has_permission("admin")) {

						?>

						<button class="btn btn-primary" name="approve_submit"  type="submit" >Approve</button>
						<?php
					} ?>


				</div>
			</form>

			

		</div>


	</div>


</div>