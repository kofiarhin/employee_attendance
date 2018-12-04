<?php 



require_once "header.php";


if(!$user->logged_in()) {

	Redirect::to("login.php");
}


if(!$user->has_permission("admin")) {

	Redirect::to("login.php");
}


$reimbursement = new Reimbursement;

$datas = $reimbursement->get_all();


?>


<div class="container">


	<h1 class="title text-center">Reimbursements!</h1>
	<div class="row justify-content-center">




		<div class="col-md-8">

			
			<?php 


			if(!$datas) {

				?>


				<p class="alert alert-warning">No Requests Yet!</p>

				<?php  
			} else {


				?>

				<table class="table table-hover">

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


						<?php 

						foreach($datas as $data) {

							//var_dump($data);

							$id = $data->rem_id;
							$created_on = $data->created_on;
							$name = $data->first_name." ".$data->last_name;
							$amount= $data->amount;


							$status = ($data->approved == 0) ? "pending" : "approved";




							?>




							<tr class="<?php if($data->approved == 0) { echo "table-danger";} else { echo "table-success";} ?>">
								<td><?php echo $created_on; ?></td>
								<td class="text-capitalize"><?php echo $name; ?></td>
								<td><?php echo $amount; ?></td>
								<td><?php echo ucfirst($status); ?></td>
								<td><a href="view_reimbursement.php?id=<?php echo $id; ?>">View</a></td>
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