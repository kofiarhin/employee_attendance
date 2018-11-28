<?php 


require_once "header.php";

//var_dump($user);

$user_id = Input::get("user_id");


$positions = $user->get_positions();

if(!$user_id) {


	redirect::to("route.php");
}

$user  = new User($user_id);


if(!$user->exist()) {

	session::flash("error", "Employee Data cannot be found!");
	Redirect::to("employees.php");
}

//var_dump($user->data());

$person_pic = $user->data()->profile_pic;
$first_name= $user->data()->first_name;
$last_name = $user->data()->last_name;
$position = $user->data()->position_name;
$email = $user->data()->email;
$contact= $user->data()->contact;

//echo $person_pic;

?>


<section id="user">




	<div class="container">


		<div class="row justify-content-center">


			<div class="col-md-3">

				<div class="profile-face" style="background-image: url(img/<?php echo $person_pic; ?>)">


				</div>

				<div class="button-wrapper">

					<a href="change_profile.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary btn-lg btn-block">Change</a>

				</div>

			</div>


			<div class="col-md-5">


				<?php 


							//check for save changes
				if(Input::exist('post', 'save_submit')) {



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

							'first_name' => Input::get('first_name'),
							'last_name' =>  Input::geT('last_name'),
							'position' =>  input::get('position'),
							'email' => Input::get('email')

						);


						$update = $user->update($user_id, $user_fields);

						if($update) {


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


				<form action="" method="post">


					<div class="row">
						

						<div class="col">

							<div class="form-group">

								<label for="first_name">First Name</label>
								<Input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo ucfirst($first_name); ?>">


							</div>

						</div>

						<div class="col">
							
							
							<div class="form-group">

								<label for="last_name">Last Name</label>
								<Input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo ucfirst($last_name); ?>">


							</div>

						</div>



					</div>


					


					


					<div class="form-group">

						<label for="staff_id">Staff ID</label>

						<input type="text" disabled class="form-control" value="101860<?php echo $user_id; ?>">

					</div>



					<div class="form-group">

						<label for="first_name">Position</label>

						<input type="text" class="form-control" value="<?php echo $position; ?>" disabled>

						<span><a href="change_position.php?user_id=<?php echo $user_id; ?>" style="margin-left: 10px; margin-top:0.8em; display: inline-block">Change Position</a></span>

					</div>



					<div class="form-group">

						<label for="first_name">Email</label>
						<Input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" disabled>

						<span><a href="change_email.php?user_id=<?php echo $user_id; ?>" style="margin-left: 10px; margin-top:0.8em; display: inline-block">Change Email</a></span>


					</div>



					<div class="form-group">

						<label for="first_name">Contact</label>
						<Input type="text" class="form-control" name="contact" placeholder="First Name" value=<?php echo "0".$contact; ?>>


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

