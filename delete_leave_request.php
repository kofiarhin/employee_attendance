<?php 


	require_once "core/init.php";



	$request_id = Input::get("request_id");

	$leave  = new Leave;


	$delete = $leave->delete($request_id);

	Redirect::to("route.php");
 ?>