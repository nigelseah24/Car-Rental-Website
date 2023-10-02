<?php

	include("connection.php");
	include("functions.php");

	// Retrieve the reservation ID from the query string
	$reservation_id = $_GET['id'];

	// Retrieve the reservation data from the database
	$reservation_data_query = "SELECT * FROM Reservation, Car where (Reservation.reservation_id = '$reservation_id') && (Reservation.car_model_id = Car.car_model_id) limit 1";
	$reservation_data_result = mysqli_query($con, $reservation_data_query);
	$reservation_data = mysqli_fetch_assoc($reservation_data_result);

	$car_name_query = "SELECT car_name FROM Car WHERE car_model_id = '" . $reservation_data['car_model_id'] . "'";
	$car_name_result = mysqli_query($con, $car_name_query);
	$car_name = mysqli_fetch_assoc($car_name_result);
	
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Reservation</title>
	<link rel="stylesheet" href="style.css">
	<div id="box">
    <div class="login-box" style="width: 800px;">
	<style>

		.reservation-table {
			margin: 0 auto;
			color: white;
			background: linear-gradient(to left,#4ca1af, #c4e0e5);
			box-shadow: 0px 0px 5px #ccc;
			border: none;
			border-radius: 5px;
			width: 100%;
			height: 80px;
		}

		.reservation-table th {
			border: 1px solid white;
			font-weight: bold;
			font-size: 20px;
		}

		h3 {
			text-align: center;
			color: white;
			font-size: 20px;
			margin: 0;
			margin-top: 15px;
			padding: 10px;
		}

		p, a {
			letter-spacing: 2px;
		}

	</style>
</head>
<body>
	<a href="customerIndex.php" style="color: white;">Go Back</a><br><br>
	<h1>Update Reservation</h1>
	<table class="reservation-table">
		<tr>
			<th style="width: 80px;">Reservation ID</th>
			<th style="width: 200px;">Car</th>
			<th style="width: 110px;">Start date</th>
			<th style="width: 110px;">End date</th>
		</tr>
		<tr>
			<td><?php echo $reservation_id; ?></td>
			<td><?php echo $reservation_data['car_name']; ?> (<?php echo $reservation_data['car_colour']?>)</td>
			<td><?php echo $reservation_data['start_date']; ?></td>
			<td><?php echo $reservation_data['end_date']; ?></td>
		</tr>
	</table>

	<h3>What would you like to change: </h3>
	<form method="post">
	<div style="display: flex; justify-content: center;">
	<a href="updateReservationCarIndex.php?id=<?php echo $reservation_id ?>" class="btn btn-pencil" style="letter-spacing: 5px;">Car</a><br><br>
	<a href="updateReservationDate.php?id=<?php echo $reservation_id ?>&car_name=<?php echo $reservation_data['car_name'] ?>&car_colour=<?php echo $reservation_data['car_colour'] ?>&car_model_id=<?php echo $reservation_data['car_model_id'] ?>&start_date=<?php echo $reservation_data['start_date'] ?>&end_date=<?php echo $reservation_data['end_date'] ?>" style="letter-spacing: 5px;">Date</a>
	</form>
</div>
</div>
</body>
</html>

