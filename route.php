<?php 

	require_once "core/init.php";


	if(session::exist("user") && session::get("user") == "admin") {


		redirect::to("admin_dashboard.php");
	}




	else if(session::exist('user')) {

		redirect::to("employee_dashboard.php");
	}