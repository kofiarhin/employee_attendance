<?php 

	require_once "core/init.php";


	$user = new User;


	if(!$user->logged_in()) {

		Redirect::to("login.php");
	}



	if($user->has_permission("admin")) {

		Redirect::to("admin_dashboard.php");
	} else {


		Redirect::to("employee_dashboard.php");
	}
