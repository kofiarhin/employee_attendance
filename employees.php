<?php 


require_once "header.php";



$datas = $user->get_all_users();



//var_dump($datas);

?>


<section id="employees">
	
	

	<div class="container">


		<h1 class="title text-center">List of Employees!</h1>



		<div class="row">

			<?php 


			foreach($datas as $data) {

					//var_dump($data);

					$name = $data->first_name. " ".$data->last_name;
					$person_pic = $data->profile_pic;
					$position = $data->position_name;
					echo $person_id = $data->user_id;


				?>



				<div class="col-md-3 " >

					<div class="emp-unit">


						<div class="face" style="background-image: url(img/<?php echo $person_pic; ?>)">

						</div>

						<div class="content">
							<p class="name text-capitalize"><?php echo $name; ?></p>
							<p class="position text-capitalize"><?php echo $position; ?></p>

						</div>



					<a href="view_user.php?user_id=<?php echo $person_id; ?>" class="btn btn-primary">View</a>



					</div>
				</div>

				<?php 

			}



			?>
			
			


			


		</div>


	</div>



</section>

