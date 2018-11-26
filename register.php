<?php 

require_once "header.php";

$positions = $user->get_positions();

?>


<section id="register">

	<div class="container">


		<h1 class="title text-center">Register Employee</h1>
	</div>

	<div class="row justify-content-center">

		<div class="col-md-5">


			<!--====  check if user has submitted data=======-->


			<?php 


			if(Input::exist('post', 'register_submit')) {


						//validate data

				$validation = new Validation;


						//validation fields and their requirements

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

						'required' => true,
						'min' => 10

					),


					'email' => array(


						'required' => true,
						'unique' => 'users'


					),

					'position' => array(


						'required' => true
					),


					'grade' => array(


							'required' => true
					) ,


					'password' => array(

						'required' => true

					),

					'password_repeat' => array(


						'matches' => 'password'

					)

				);


				$check = $validation->check($_POST, $fields);

				if($check->passed()) {


					$salt = Hash::salt(32);
					$password = Hash::make(Input::get('password') , $salt);


					$user_fields = array(


						'first_name' => Input::get('first_name'),
						'last_name' =>  Input::get('last_name'),
						'email' =>  Input::get('email'), 
						'contact' => Input::get('contact'),
						'position' => Input::get("position"),
						'grade' => (int) Input::get('grade'),
						'password'  => $password,
						'salt' => $salt,
						'profile_pic' => 'default.jpg',
						'created_on' => date('Y-m-d H:i:s')


					);


					var_dump($user_fields);

					$user = new User;

					$account = $user->create($user_fields);

					if($account) {

						Redirect::to("admin_dashboard.php");
					} else {


						?>

						<p class="alert alert-danger"><?php echo Session::flash("error"); ?></p>


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


				<div class="row">
					

					<div class="col">

						<div class="form-group">

							<label for="first_name">First Name</label>

							<Input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo Input::get('first_name'); ?>">

						</div>
						

					</div>


					<div class="col">
						
						
						<div class="form-group">

							<label for="last_name">Last Name</label>

							<Input type="text" class="form-control" name="last_name" value="<?php echo Input::get("last_name"); ?>"  placeholder="Enter Last Name">


						</div>

					</div>


				</div>

				
				<div class="row">
					
					<div class="col">
						
						<div class="form-group">
							

							<label for="contact">Contact</label>

							<Input type="text" class="form-control" name="contact" placeholder="Enter Contact Number" value="<?php echo Input::get('contact'); ?>">


						</div>



					</div>


					<div class="col">

						<div class="form-group">


							<label for="email">Email</label>
							<Input type="email" class="form-control" name="email" value="<?php echo Input::get('email'); ?>" placeholder="Enter Email Address">


						</div>

					</div>




				</div>



				<div class="row">
					
					<div class="col">

						<div class="form-group">
							
							<label for="position">Position</label>

							<select name="position" class='form-control'>
								
								<?php 

									if($positions) {

										foreach($positions as $position) {

											?>

										<option value="<?php echo $position->position_name; ?>"><?php echo $position->position_name; ?></option>
											<?php 
										}

									}

								 ?>
							</select>
							
						</div>
						

					</div>

					<div class="col">
						
						<div class="form-group">
							
							<label for="grade">Grade</label>

							<select name="grade" id="" class="form-control">
								
								<?php 

										for($i = 1; $i < 6; $i++) {

											?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

											<?php 
										}

								 ?>
							</select>

						</div>
					</div>


				</div>


				<div class="row">
					

					<div class="col">

						<div class="form-group">


							<label for="password">Password</label>
							<Input type="password" name="password" value="<?php echo Input::get("password"); ?>" placeholder="Enter Password" class="form-control">

						</div>


					</div>




					<div class="col">

						<div class="form-group">

							<label for="password_repeat">Repeat Password</label>	


							<Input type="password"  name="password_repeat" class="form-control" value="<?php echo Input::get("password_repeat"); ?>" placeholder="Repeat Password">
						</div>

					</div>


					<button class="btn btn-block btn-primary" type="submit" name="register_submit">Register</button>






				</div>

				


			</form>
		</div>			
	</div>


</section>