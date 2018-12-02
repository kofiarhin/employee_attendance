<?php 

	
		require_once "header.php";


		//regular in house keeping


		if(!$user->logged_in()) {

			Redirect::to("login.php");
		}


		$timesheet_id = Input::get("timesheet_id");


		if(!$timesheet_id) {

			Session::flash("error", "Timecard does not exist");
			Redirect::to("route.php");
		}


		$timesheet =  new Timesheet();


		$time_card = $timesheet->get_timesheet($timesheet_id);

 ?>


