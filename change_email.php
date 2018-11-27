<?php 


	require_once "header.php";


	$user_id = Input::get('user_id');

	if(!$user_id) {

		Redirect::to("login.php");


	}



	$user = new User($user_id);



	if($user->exist()) {


		$email = $user->data()->email;
	}



 ?>


<div class="container">
	
		<h1 class="title text-center">Change Email</h1>

		<div class="row justify-content-center">


			<?php 

					if(Input::exist('post', 'email_submit')) {

					

						$validation = new Validation;

						$fields = array(


							"email" => array(

								'required' => true

							)

						);


						$check = $validation->check($_POST, $fields);


						if($check->passed()) {


							$new_email = input::get("email");


							$fields = array(

								'email' => $new_email
							);

							$update = $user->update($user_id, $fields );

								if($update) {


									Session::flash("success", "Email Successfully Updated");


									Redirect::to("view_user.php?user_id=".$user_id);



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
			

				<div class="col-md-4">
					

					<form action="" method="post">
						
		<div class="form-group">
			
			<label for="email">Email</label>

			<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter New Email Address">



		</div>


		<button class="btn btn-primary" type="submit" name="email_submit">Change</button>


					</form>
				</div>


		</div>



</div>