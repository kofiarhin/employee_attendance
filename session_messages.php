<?php 

	//session::test();


	if(session::exist('success')) {

		
		?>

	<p class="alert alert-success text-center"><?php echo session::flash("success"); ?></p>

		<?php 		


	}


	if(session::exist("error")) {


		?>

		<p class="alert alert-danger text-center"><?php echo session::flash("error"); ?></p>


		<?php 
	}


 ?>