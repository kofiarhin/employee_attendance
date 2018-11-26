<?php 

		require_once "core/init.php";



		Session::delete('user');

		Redirect::to("index.php");

 ?>