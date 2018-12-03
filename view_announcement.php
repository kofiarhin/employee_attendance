<?php 


	require_once "header.php";

	$id = Input::get('id');



	$announcement = new Announcement($id);


	if(!$announcement->exist()) {


		Session::flash("error", "Announcement does not exist");

		Redirect::to("index.php");
	}


	$data = $announcement->data();

	$cover_image  = $data->cover_image;
	$title = $data->title;
	$description = $data->description;
	$created_on = (new DateTime())->format("jS M Y");




 ?>


 <div class="container">
 	


		<div class="row justify-content-center">
			

			<div class="col-md-8">
				
				<h1 class="ann-title"><?php echo $title; ?></h1>
				<p class="text">Posted On: <?php echo $created_on; ?></p>

				<div class="main-cover" style="background-image: url(img/<?php echo $cover_image; ?>)"></div>

				<p class="ann-text"><?php echo $description; ?></p>

				<?php 

							if($user->has_permission("admin")) {


								//show the edit and delete button


								?>

			<div class="button-wrapper">
				
				<a href="edit_annoncement.php" class="btn btn-primary">Edit</a>
				<a href="delete_annoucement.php" class="btn btn-danger">Delete</a>

			</div>


								<?php 
							}

				 ?>
			</div>
	

		</div>



 </div>