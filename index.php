<?php 


require_once "header.php";


$announcements = new Announcement();


$datas = $announcements->get_all();


?>

<h1 class="title text-center">Latest New!</h1>



<div class="container">
	




		<?php 


		if(!$datas) {


			?>
			<p class="alert alert-warning">No Annoucement Yet!</p>


			<?php

		} else {


			foreach($datas as $data) {

				$cover_image = $data->cover_image;
				$title = substr($data->title, 0, 60) ;
				$description = substr($data->description, 0, 200);
				$id = $data->id;



				?>


					<div class="row justify-content-center">
						
							<div class="col-md-6 news-unit">
								
								<div class="thumbnail" style="background: url(img/<?php echo $cover_image; ?>)"></div>

								<div class="content">
									
									<h2 class="news-title"><?php echo $title; ?></h2>
									<p class="news-text"><?php echo $description; ?></p>

									<a href="view_announcement.php?id=<?php echo $id; ?>" class="btn btn-primary">Read More</a>
								</div>
							</div>


					</div>
								




				<?php 
			}


		}

		?>





	


</div>


<?php 


require_once "footer.php";

?>