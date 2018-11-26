<?php 


require_once "header.php";

$user_id = input::get("user_id");

if(!$user_id) {


	redirect::to("route.php");
}





if($user->logged_in() || session::get("user") == "admin") {


			if(session::get("user") == "admin") {


				$user = new user($user_id);

				if($user->exist()) {

					$first_name = $user->data()->first_name;
					$last_name = $user->data()->last_name;
					$email = $user->data()->email;
					$contact = $user->data()->contact;
					$position = $user->data()->position;
					$grade = $user->data()->grade;
					$person_pic  = $user->data()->profile_pic;
				}


			}

	?>


	<section id="user">




		<div class="container">


			<div class="row">


				<div class="col-md-3 offset-md-2">

					<div class="profile-face" style="background-image: url(img/<?php echo $person_pic; ?>)">

					</div>

				</div>


				<div class="col-md-5">


					<?php 


							//check for save changes
					if(input::exist('post', 'save_submit')) {

						

						$validation = new Validation;

						$fields = array(


							'first_name' => array(

								'required' => true,
								'min' => 2,
								'max' => 50

							),


							'last_name' => array(


									'required' => true,
									'min' => 2, 
									'max' => 50

							),


							'email' => array(

								'required' => true

							)

						);


						$check = $validation->check($_POST, $fields);


						if($check->passed()) {


								$user_fields = array(

									'first_name' => input::get('first_name'),
									'last_name' =>  input::geT('last_name'),
									'email' => input::get('email')

								);
								

								$update = $user->update($user_fields);



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

							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo ucfirst($first_name); ?>">


						</div>


						<div class="form-group">
							
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo ucfirst($last_name); ?>">


						</div>



						<div class="form-group">
							
							<label for="first_name">Position</label>
							<input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo ucfirst($position); ?>" disabled>


						</div>



						<div class="form-group">
							
							<label for="first_name">Email</label>
							<input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">


						</div>



						<div class="form-group">
							
							<label for="first_name">Contact</label>
							<input type="text" class="form-control" name="contact" placeholder="First Name" value=<?php echo "0".$contact; ?>>


						</div>


						<div class="button-wrapper">
							
							
							<button class="btn btn-primary" type="submit" name="save_submit">Save Change</button>

							<?php 


									if(session::get('user') == "admin") {


										?>

				<button class="btn btn-danger" type="submit" name="delete_submit">Delete</button>

										<?php
									}

							 ?>


						</div>


					</form>


				</div>


			</div>



		</div>


	</section>

	<?php 



}	 else {



	echo "unathorized access";
}


?>