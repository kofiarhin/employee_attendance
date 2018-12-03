<?php 

require_once "header.php";

?>


<div class="container">

	<h1 class="title text-center">Create Announcement!</h1>


</div>

<div class="container">

	<div class="row justify-content-center" >


		<div class="col-md-6">

			<?php 

			if(Input::exist("post", "post_submit")) {

				$validation = new Validation;


				$fields = array(

					'title' => array(

						'required' => true
					),

					'description' => array(

						'required' => true

					)


				);


				$check = $validation->check($_POST, $fields);

				if($check->passed()) {


					$announcement = new Announcement();

					$file = Input::get("cover_image");


					$file_name = $file['name'];


					if(empty($file_name)) {


						?>

						<p class="alert alert-danger text-center">Please select a cover image!</p>

						<?php 


					} else {


						$file_new_name = Helper::upload_file($file, array('jpg', 'png'), "img");

						if($file_new_name) {


										//create announcement

							$fields = array(

								'title' => Input::get("title"),
								'description' => Input::get("description"),
								'cover_image' => $file_new_name,
								'created_on' => date("Y-m-d H:i:s")

							);

							var_dump($fields);

							$create = $announcement->create($fields);

							var_dump($create);

							if($create) {

								Redirect::to("index.php");
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
			
			<form action="" method="post" enctype="multipart/form-data">
				
				<div class="form-group">

					<label for="title">Title</label>

					<input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo Input::get('title'); ?>">


				</div>

				<div class="form-group">

					<label for="description">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo Input::get("description"); ?></textarea>

				</div>


				<div class="form-group">
					
					<label for="cover">Cover Image</label>
					<input type="file" name="cover_image" class="form-control">

				</div>


				<button class="btn btn-primary" type="submit" name="post_submit">Post Announcement</button>

			</form>


		</div>



	</div>


</div>