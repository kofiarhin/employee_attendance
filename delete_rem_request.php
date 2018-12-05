<?php 


	require_once "core/init.php";

	$reimbursement = new Reimbursement;


	//create a method to delete reimbursement

	$rem_id = Input::get("rem_id");

	$delete = $reimbursement->delete($rem_id);

	Redirect::to("admin_view_reimbursement.php");

 ?>