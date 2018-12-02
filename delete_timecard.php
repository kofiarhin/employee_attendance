<?php 


	require_once "core/init.php";


	$user = new User;

	$timesheet = new Timesheet;

	$timesheet_id = Input::get("timesheet_id");


	//general house keeping

	if(!$user->logged_in()) {

		Redirect::to("login.php");
	}


	$delete = $timesheet->delete($timesheet_id);


	if($delete) {

		Redirect::to("employee_timesheet.php");

	}


 ?>