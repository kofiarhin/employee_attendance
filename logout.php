<?php 

		require_once "core/init.php";



		session::delete('user');

		redirect::to("index.php");

 ?>