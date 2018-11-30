
<?php 


		require_once "header.php";


		//get all supervisors



		$team = new Team();

		$supervisors = $team->get_supervisors();



//


 ?>

<div class="container">
	
		 <h1 class="title text-center">Assign To Supervisor</h1>


		<div class="row justify-content-center">
			

			<div class="col-md-5">
				
				 <form action="" method="post">
				 	
						<div class="form-group">


							<label for="supervisor">Supervisor Name</label>
						
								<select name="supervisor_id" class="form-control">


									<?php 

											if($supervisors) {

												foreach($supervisors as $user) {

														$name = $user->first_name. " ".$user->last_name;
														$person_id = $user->user_id;

													?>
						<option value="<?php echo $person_id; ?>"><?php echo $name; ?></option>


													<?php 
												}
											}


									 ?>
									
										

								</select>		


						</div>


						<button class="btn btn-primary">Assign</button>
					


				 </form>

			</div>


		</div>

		



</div>
 

