<?php 

require_once "header.php";



if(!session::get('user') == "admin") {



	Redirect::to("login.php");

}


$user_id = Input::get('user_id');


$positions = $user->get_positions();






?>



<div class="container">

	<h1 class="title text-center">Change Position</h1>

	<div class="row justify-content-center">




		<div class="col-md-4">


			<!--====  check if change =======-->



			<?php 


					if(Input::exist("post", "change_submit")) {


							$fields = array(

								'position' => input::get('position')

							);



							

							$update = $user->update($user_id, $fields);


							if($update) {

								session::flash("success", "Position successfully changed");

								Redirect::to("view_user.php?user_id=".$user_id);

							}


					}

			 ?>			

			<form action="" method="post">

				<div class="form-group">

					<label for="position">Position</label>
					<select name="position" class="form-control">
						

						<?php if($positions){



							foreach($positions as $position) {


								?>

								<option value="<?php echo $position->position_name; ?>"><?php echo $position->position_name; ?></option>


								<?php 

							}
						} ?>


					</select>


				</div>


				<button class="btn btn-primary" type="submit" name="change_submit">Change</button>


			</form>


		</div>


	</div>



</div>