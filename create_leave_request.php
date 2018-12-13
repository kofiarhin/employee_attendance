<?php 

require_once "header.php";

$user_request = new Leave();

	//var_dump($leave_request);

	 //var_dump($leave_request);

?>


<div class="container">

	<?php 

	if($user_request->eligible()) {

		?>

		<h1 class="title text-center">Create Leave Request</h1>


		<div class="row justify-content-center">


			<div class="col-md-3">

				<?php 

						//check if user has submitted data

				if(Input::exist("post", "request_submit")) {

					$validation = new Validation;

					$fields = array(


						'start_date' => array(

							'required' => true
						),

						'end_date' => array(

							'required' => true

						)

					);

					$checks = $validation->check($_POST, $fields);

					if($checks->passed()) {

						
						//additional validtaion will refactor later
						//add this functionatlity to validation class


						$start_date = Input::get("start_date");
						$end_date  = Input::get('end_date');


						if($start_date > $end_date) {



							?>

		<p class="alert alert-danger">End Date Cannot be in the past!</p>

							<?php 
						}  else {

							//calculate the number of days left and deduct from
							//number of days user is requesting

							$user_id = Session::get('user');


							$leave_fields = array(

								'start_date' => Input::get('start_date'),
								'end_date' => Input::get("end_date")
							);

							$create = $user_request->create($user_id, $leave_fields);

							if(!$create->created()) {


								?>

	<p class="alert alert-danger"><?php echo $create->error(); ?></p>

								<?php 
							} else{


									Redirect::to("route.php");

							}


						}


					} else {


							foreach($checks->errors() as $error) {


								?>
			<p class="alert alert-danger"><?php echo $error; ?></p>

								<?php
							}


					}
				}


				 ?>

				<form action="" method="post">

					<div class="form-group">
						
						<label for="start_date">Start Date</label>
						<input type="date" name="start_date" class="form-control" >
						
					</div>

					<div class="form-group">
						
							<label for="end_date">End Date</label>
							<input type="date" class="form-control" name="end_date">

					</div>

					<button class="btn btn-primary" type="submit" name="request_submit">Submit Request</button>


				</form>
			</div>

		</div>

		<?php 
	} else {


		?>

		<p class="alert alert-danger text-center"><?php echo $user_request->error(); ?></p>

		<?php 
	}


	?>
</div>