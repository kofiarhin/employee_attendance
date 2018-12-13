<?php 


require_once "header.php";

//var_dump($user);

$person_id = Input::get("user_id");


$positions = $user->get_positions();

if(!$person_id) {


	Redirect::to("route.php");
}

$person  = new User($person_id);


if(!$person->exist()) {

	session::flash("error", "Employee Data cannot be found!");
	Redirect::to("employees.php");
}

//var_dump($user->data());

$person_pic = $person->data()->profile_pic;
$first_name= $person->data()->first_name;
$last_name = $person->data()->last_name;
$position = $person->data()->position_name;
$email = $person->data()->email;
$contact= $person->data()->contact;

//echo $person_pic;

?>


<section id="user">




	<div class="container">


		<div class="row justify-content-center">


			<div class="col-md-3">

				<div class="profile-face" style="background-image: url(img/<?php echo $person_pic; ?>)">


				</div>

				<div class="button-wrapper">

					<a href="change_profile.php?user_id=<?php echo $person_id; ?>" class="btn btn-primary btn-lg btn-block">Change</a>

					<?php if($user->has_permission("admin") && $person_id != Session::get('user')) {



							?>

		<a href="view_user_timesheet?user_id=<?php echo $person_id; ?>" class="btn btn-link btn-lg">View Timesheet</a>


							<?php 



					} ?>

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

						'contact' => array(

							'required' => true

						)


					);


					$check = $validation->check($_POST, $fields);


					if($check->passed()) {


						$user_fields = array(

							'first_name' => Input::get('first_name'),
							'last_name' =>  Input::geT('last_name'),
							'contact' => Input::get("contact")

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


				//check if delete button


				if(Input::exist("post", "delete_submit")) {

						
				
							$delete = $user->delete($person_id);

							if($delete) {

								Redirect::to("employees.php");
							} else {

								?>

		<p class="alert alert-danger">There was a problem deleting account!</p>

								<?php  
							}



				}


				?>


				<form action="" method="post">


					<!--====  hidden fields=======-->

					<input type="hidden" name="person_id" value="<?php echo input::get('user_id '); ?>">


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

						<input type="text" disabled class="form-control" value="101860<?php echo $person_id; ?>">

					</div>



					<div class="form-group">

						<label for="first_name">Position</label>

						<input type="text" class="form-control" value="<?php echo $position; ?>" disabled>

						<span><a href="change_position.php?user_id=<?php echo $person_id; ?>" style="margin-left: 10px; margin-top:0.8em; display: inline-block">Change Position</a></span>

					</div>



					<div class="form-group">

						<label for="first_name">Email</label>
						<Input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" disabled>

						<span><a href="change_email.php?user_id=<?php echo $person_id; ?>" style="margin-left: 10px; margin-top:0.8em; display: inline-block">Change Email</a></span>


					</div>



					<div class="form-group">

						<label for="first_name">Contact</label>
						<Input type="text" class="form-control" name="contact" placeholder="First Name" value=<?php echo "0".$contact; ?>>


					</div>


					<div class="button-wrapper">


						<button class="btn btn-primary" type="submit" name="save_submit">Save Change</button>


					<!--====  if user is the administrator show the delete button=======-->


					<?php 

							$user  = new User;

							if($user->has_permission("admin")) {

								?>

			<button class="btn btn-danger" name="delete_submit" type="submit" style="margin-left: 20px;">Delete</button>

								<?php 
							}

					 ?>
						


					</div>


				</form>


			</div>


		</div>



	</div>


</section>

