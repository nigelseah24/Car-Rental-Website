<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$staff_data = check_staff_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Car Rental Services</title>

	<style>
		p, a {
			letter-spacing: 2px;
		     }
  </style>

	<script src="script.js"></script>
</head>
<body>
	<div id="box">
	<link rel="stylesheet" href="style.css">
	<div class="login-box">
	<a href="staffLogout.php" style="color: white;">Logout</a><br><br>
	<form method="post">
	<h1>Hello, <?php echo $staff_data['staff_name']; ?>.</h1>
	<h2>Staff ID: <?php echo $staff_data['staff_id']; ?></h2>
	<a href="createReservation.php" style="letter-spacing: 5px;">Create Reservation</a>
	<a href="customerLogin.php" style="letter-spacing: 5px;">Customer Login</a>	
	</form>
	</div>
	</div>
</body>
</html>