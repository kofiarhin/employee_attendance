<?php 


require_once "header.php";


$id = Input::get('id');



if(!$user->logged_in()) {


	Redirect::to("login.php");
}


if(!$id) {

	Session::flash("error", "Request Does not exist");


	Redirect::to("route.php");


}



$reimbursement = new Reimbursement;

$data = $reimbursement->get_all($id);


var_dump($data);


/*
if(!$data) {

	Session::flash("error", "Data does not exist");

	Redirect::to("route.php");

}

*/

$first_name = $data->first_name;
$last_name  = $data->last_name;

$profile_pic = $data->profile_pic;
$created_on = $data->request_created_on;


$approved = $data->approved;


$status = ($approved == 0) ? "Pending" : "Approved";

$rem_id = $data->rem_id;






?>


<div class="container">

	<div class="row justify-content-center">


		<table class="table table-bordered">


			<thead>

				<tr>
					<td>Requested On</td>
					<td>Name</td>
					<td>Status</td>
					<td>Action</td>
				</tr>

			</thead>

			<tbody>
				

				<tr>
					
				<td>
				
					<?php echo $created_on; ?>

				</td>

				<td>
					<div class="t-face" style="background-image: url(img/<?php echo $profile_pic; ?>)"></div>
				</td>
				<td><?php echo $status; ?></td>
				<td><a href="edit_reimbursement.php?id=<?php echo $rem_id ?>">Edit</a></td>

				</tr>
			</tbody>


		</table>



		<div class="button-wrapper">
			
			<?php 

					if($user->has_permission("admin")) {


						?>

				<a href="delete_reimbursement.php" class="btn btn-danger">Delete</a>
				<a href="approve_reimbursement.php" class="btn btn-success">Approve Payment</a>


						<?php 
					}

			 ?>


		</div>


	</div>


</div>