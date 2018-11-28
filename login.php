<?php 

require_once "header.php";


	//generate admin credentials
	/*
	$salt = "dfas;kfkdjsadfdafd";
	$password = Hash::make("password", $salt);

	echo $password;
	echo "<br>";
	echo $salt;	

	*/

?>

<section id="login">
	
	<div class="container">

		<h1 class="title text-center">Login  Page!</h1>


		<div class="row justify-content-center">

			<div class="col-md-5">

				<?php 

				if(Input::exist("post", "login_submit")) {

					$validation = new Validation;

					$fields = array(

						'user_input' => array(


							'required' =>  true
						),

						'password' => array(

							'required' =>  true
						)

					);

					$check = $validation->check($_POST, $fields);

					if($check->passed()) {


							$user_input = input::get("user_input");

							$password = Input::get("password");

							if(is_numeric($user_input)) {

								$prefix = substr($user_input, 0, 6);

								//echo $prefix;

								$pattern = array(101860, 200300);

								if(in_array($prefix, $pattern)) {

									$user_id = substr($user_input, 6);
								

									$login = $user->login($user_id, $password);

									if(!$login) {

										//echo "here";

										Session::flash("error", "Invalid Staff ID/Password Combination");

										Redirect::to("login.php");

									} else {

										Redirect::to("route.php");
									}
								} else {

									Session::flash("error", "Invalid Staff Id Format");

									Redirect::to("login.php");
								}


							} else {

								$login = $user->login($user_input, $password);

								if(!$login) {

									Session::flash("error", "Invalid Email/Password Combination");

									Redirect::to("login.php?user_input=".$user_input);
								} {

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



				<form action="" method="post" class="bordered">

					<div class="form-group">
						
						<label for="email">Email or Employee ID</label>
						<input type="text" name="user_input" placeholder="Enter Your ID" value="<?php echo Input::get('user_input'); ?>" class="form-control">
					</div>

					<div class="form-group">
						
						<label for="password">Password</label>

						<input type="password"  name="password"class="form-control" placeholder="Enter Password" value="<?php echo Input::get('password'); ?>">

					</div>

					<div class="form-group">
						
						<button class="btn btn-primary" type="submit" name="login_submit">Login</button>
						
					</div>


					<div class="form-group">
						<p class="lead"><a href="forgot_password.php">Forgot Password?</a></p>
						
					</div>

				</form>
			</div>

		</div>

	</div>
	
</section>