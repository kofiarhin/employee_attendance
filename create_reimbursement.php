<?php 


require_once "header.php";

?>


<div class="container">


	<h1 class="title text-center">Reimbursement</h1>

	<div class="row justify-content-center">

		
		<div class="col-md-5">


			<?php 


					if(Input::exist("post", "submit")) {

						

							$validation = new Validation;

							$fields = array(

								'amount' => array(

									'required' => true

								),

								'description' => array(

									'required' => true

								)

							);

							

							$check = $validation->check($_POST, $fields);

							if($check->passed()) {

								
									$reimbursement = new Reimbursement;

									$fields = array(

										'user_id' => (int) Session::get('user'),
										'description' => Input::get("description"), 
										"amount" => (int) Input::get("amount"), 
										'approved' => 0
									);

									$create = $reimbursement->create($fields);

									if($create) {


										Redirect::to("route.php");
									} else {


										?>


		<p class="alert alert-danger">There was a problem sending request. Contact Administrator!</p>

										<?php 
									}



							} else {


								foreach($check->errors() as $error) {

									?>

			<p class="alert alert-danger"><?php echo $error; ?></p>

									<?php 
								}
							}	


					}

			 ?>


			<form action="" method="post">


				<div class="form-group">

					<label for="reasons">Claim Reasons</label>
					<select name="description" id="" class="form-control">

						<option value="medical">Medical</option>
						<option value="travel">Travel</option>


					</select>


				</div>


				<div class="form-group">
						
						<label for="">Receipt Amount</label>
						<input type="text" class="form-control" placeholder="Enter Receipt Amouont!" name="amount">


				</div>



				<button class="btn btn-primary" type="submit" name="submit">Submit</button>


			</form>
		</div>



	</div>

</div>




