<?php 

require_once "header.php";


if(!$user->logged_in()) {

	Redirect::to("login.php");
}

$id = Input::get("id");

$leave = new Leave($id);

if(!$leave->exist()) {

	Session::flash("error", "Data Does not exist");

	Redirect::to("route.php");
}

$data = $leave->data();

	//will come back to you later
	//work on displaying data in a table


?>


<div class="container">

	<h1 class="title text-center">Edit Leave Request!</h1>


	<div class="row justify-content-center">
		<div class="col-md-8">


			<?php 

					//check if user has submitted date


			if(Input::exist("post", "save_submit")) {


				$validation = new Validation();

				$fields = array(

					'start_date' => array(


						'required' => true
					),

					"end_date" => array(

						'required' => true

					)

				);


				$check = $validation->check($_POST, $fields);

				if($check->passed()) {

					$start_date = Input::get("start_date");

					$end_date = Input::get("end_date");

					if($end_date < $start_date) {

						?>

	<p class="alert alert-danger"> End Date Cannot be in the past!</p>

						<?php 
					} else {

						$update_fields = array(

								"start_date" => $start_date,
								"end_date" => $end_date
						);


						$update = $leave->update_request($id, $update_fields);


						if($update) {

							Redirect::to("route.php");
						} 


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

					<label for="start_date">Start Date</label>
					<input type="date" class="form-control" name="start_date">
				</div>

				<div class="form-group">
					
					<label for="end_date">End Date</label>

					<input type="date" class="form-control" name="end_date">

				</div>


				<button class="btn btn-primary" type="submit" name="save_submit">Save Changes</button>
			</form>

		</div>



	</div>


</div>