<?php 


		require_once "header.php";


		if(!$user->logged_in()) {

			Redirect::to("login.php");
		}


		$timesheet_id = Input::get("timesheet_id");

		//regular in house keeping

 ?>


 <div class="container">
 	

 		<h1 class="title text-center">Edit Timecard</h1>

		<div class="row justify-content-center">
			
			<div class="col-md-5">
				
				<form action="" method="post">
					

					<div class="form-group">
						
						<label for="time_in">Time In</label>
						<select name="time_in" class="form-control">
								
							<option value="">8:00</option>
							<option value="">9:00</option>
							<option value="">10:00</option>
							<option value="">11:00</option>
							<option value="">12:00</option>
							<option value="">13:00</option>
							<option value="">14:00</option>
							<option value="">15:00</option>
							<option value="">16:00</option>
							<option value="">17:00</option>

						</select>
					</div>



					<div class="form-group">
						
						<label for="time_in">Time Out</label>
						<select name="time_in" class="form-control">
								
							<option value="">8:00</option>
							<option value="">9:00</option>
							<option value="">10:00</option>
							<option value="">11:00</option>
							<option value="">12:00</option>
							<option value="">13:00</option>
							<option value="">14:00</option>
							<option value="">15:00</option>
							<option value="">16:00</option>
							<option value="">17:00</option>

						</select>
					</div>

				
				<button class="btn btn-primary">Save Changes</button>

				</form>
			</div>

		</div>



 </div>
