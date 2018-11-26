<?php 


	require_once "header.php";


	$user_id = Input::get('user_id');

	if(!$user_id) {

		Redirect::to("login.php");


	}



 ?>