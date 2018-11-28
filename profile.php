<?php 


	require_once "header.php";


		$user  = new User;


		if(!$user->logged_in()) {

			Redirect::to("login.php");
		}


		$first_name =  ucfirst($user->data()->first_name);
		$last_name =  ucfirst($user->data()->last_name);
		$profile_pic = $user->data()->profile_pic;
		$email = $user->data()->email;
		$contact = $user->data()->contact;
		$user_id = $user->data()->id;
		$position = $user->data()->position_name;

		




 ?>


 <div class="container">
 	

		<h1 class="title text-center">Profile!</h1>

		<div class="row">
			
			
			<div class="col-md-3 offset-md-3">
				
				<div class="profile-face" style="width: 90%px; height: 200px; background-image: url(img/<?php echo $profile_pic; ?>); margin: 0 auto"></div>

				<div class="button-wrapper">
					
					<a href="change_profile.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary">Change_profile</a>
				</div>
			</div>

			<div class="col-md-4">
				
				<h2 class="sub-title">Personal Information</h2>

				<form action="" method="post">
					
		
				<div class="form-group">
					
					<label for="first_name">First Name</label>

					<input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">


				</div>

				<div class="form-group">
					
					<label for="last_name">Last Name</label>

					<input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">


				</div>

				<div class="form-group">
					
					<label for="email">Email</label>

					<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">


				</div>


				<div class="form-group">
					
					<label for="email">Contact</label>

					<input type="text" name="contact" class="form-control" value="0<?php echo $contact; ?>">


				</div>


				<div class="form-group">
					
					<label for="email">Position</label>

					<input type="text" name="position" class="form-control" value="<?php echo $position; ?>" disabled>

					<span style="display: inline-block; margin: 10px"><a href="change_position.php?user_id=<?php echo $user_id; ?>">Change</a></span>


				</div>


				<button class="btn btn-primary type="submit" name="save_submit">Save Changes!</button>

				</form>
			</div>

		</div>



 </div>