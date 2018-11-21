<?php 

	
	require_once "header.php";


	


?>


			<h1 class='display-4 text-center'>Escode Framework</h1>

			<div class="container">
				
			
				<?php 

						$connection = db::get_instance();

						if($connection) {

							?>
			<p class="alert alert-success text-center">You are connected to <strong> <?php echo config::get("mysql/dbname"); ?></strong> Database!</p>

							<?php 
						}

				 ?>


			</div>

	
<?php 

	
		require_once "footer.php";

 ?>