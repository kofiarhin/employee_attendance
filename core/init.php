<?php 

	session_start();


	$GLOBALS['config'] = array (


		'app'  => array (

			'name' => 'Employee Attendance'

		), 

		'mysql' => array(

			'host' => '127.0.0.1',
			'dbname' => 'employee_attendance',
			'user' => 'root', 
			'password' =>'root'
		),


		'session' => array(

			'session_name' => 'user',
			'token_name' => 'token'

		),


		'cookie' => array(

			'cookie_name' => 'hash',
			'cookie_expiry' => 604800

		)

	);


	require_once dirname(__dir__) ."\\vendor\\autoload.php";

