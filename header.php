<?php 

use Carbon\Carbon;
require_once "core/init.php";

$user = new User;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo config::get('app/name'); ?></title>


	<!--====  font awesome=======-->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--====  bootstrap=======-->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!--====  custom css=======-->
	<link rel="stylesheet" href="css/styles.css">
	<script src='js/jquery.js'></script>
	<script src='js/main.js'></script>
</head>
<body>


	<header class="main-header">	

		<div class="container">	

			<h1 class="logo"><a href="index.php"><span>HR</span>SOL</a></h1>

			<nav>
				
				<?php 

				if($user->logged_in()) {


					$dashpath = ($user->has_permission("admin")) ? "admin_dashboard.php" : "employee_dashboard.php";

					//echo $dashpath;

					?>


					<a href="<?php echo $dashpath; ?>">Dashboard</a>


					<a href="profile.php?user_id=<?php echo $user->data()->id; ?>"><?php echo ucfirst($user->data()->first_name); ?></a>

					<a href="team.php">Team</a>
					<a href="news.php">News</a>
					
					<a href="logout.php">Logout</a>

					<?php 
				} else {


					?>

					<a href="login.php">Login</a>

					<?php 
				}


				?>


			</nav>

		</div>
		
	</header>



	<?php 

	include "session_messages.php";

	?>
