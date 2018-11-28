<?php 

require_once "header.php";


$user_id = Input::get('user_id');

?>


<div class="container">


	<h1 class="title text-center">Select Profile Picture</h1>


	<div class="row justify-content-center">


		<div class="col-md-4">


			<?php 

					if(Input::exist("post", "file_submit")) {

							$file  = input::get("file");


							$filename = $file['name'];


							if(empty($filename)) {


								?>
		<p class="alert alert-danger">Please Select a File!</p>


								<?php 
							} else {


								$upload = $user->upload_file($user_id, $file);

								if($upload) {

									Redirect::to("profile.php");
								} else {

									Session::flash("error",  "There was a problem updating profile");

									Redirect::to("change_profile.php?user_id=".$user_id);
								}


								/*
								if(!$upload) {


									Redirect::to("change_profile.php?user_id=".$user_id);
								}

								*/


							}


					}

			 ?>

			<form action=""  method="post" enctype="multipart/form-data">

				<div class="form-group">


					<label for="file">Select File</label>

					<input type="file" name="file" class="form-control">


				</div>


				<button class="btn btn-primary" type="submit" name="file_submit">Change Picture</button>


			</form>


		</div>
	</div>



</div>