<?php 

require_once "header.php";


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

						'employee_id' => array(


							'required' =>  true
						),

						'password' => array(

							'required' =>  true
						)

					);

					$check = $validation->check($_POST, $fields);

					if($check->passed()) {


							$employee_id = Input::get("employee_id");

							$password = Input::get("password");

							if($employee_id == "admin" && $password == "password") {


										Session::put(config::get("session/session_name"), "admin");

										Redirect::to("admin_dashboard.php");
							} else {




								if(!is_numeric(input::get("employee_id"))) {


									session::flash("error", "Employee ID must be a number");

									Redirect::to("login.php");


									exit();

								}


								$user = new User;

								$emp_id = Input::get("employee_id");

								$check = $user->check_id($emp_id);


								if($check->passed()) {

									$login = $user->login($emp_id,  $password);

									if($login) {

										Redirect::to("employee_timesheet.php");
									} else {

										?>

		<p class="alert alert-danger">Invalid ID/Password Combination. Try Again</p>


										<?php 
									}
								} else  {

									foreach($check->errors() as $error) {


										?>

				<p class="alert alert-danger"><?php echo $error; ?></p>

										<?php 
									}
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
						
						<label for="email">Employee ID</label>
						<input type="text" name="employee_id" placeholder="Enter Your ID" value="<?php echo Input::get('employee_id'); ?>" class="form-control">
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