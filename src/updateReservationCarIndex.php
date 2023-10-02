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
    <title>Update Car</title>
		<style>

			.update-table {
				margin: 0 auto;
				color: white;
				background: linear-gradient(to left,#4ca1af, #c4e0e5);
				box-shadow: 0px 0px 5px #ccc;
				border: none;
				border-radius: 5px;
				width: 100%;
				height: 100px;
			}

			.update-table th {
				border: 1px solid white;
				font-weight: bold;
				font-size: 25px;
				text-overflow: ellipsis; 
			}

			.update-table td {
				border: 1px solid white;
				font-weight: bold;
				font-size: 20px;
				text-overflow: ellipsis; 
				text-align: center;
			}

			h3 {
				color: white;
				font-size: 25px;
				margin: 0;
				margin-top: 15px;
				padding: 10px;
			}
			
			.card-grid {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			height: 60vh;
			grid-template-columns: repeat(4, 1fr);
			gap: 60px;
			}

			.card {
			width: 210px;
			height: 340px;
			border-radius: 20px;
			background: #f5f5f5;
			position: relative;
			padding: 1.8rem;
			border: 2px solid #c3c6ce;
			transition: 0.5s ease-out;
			overflow: visible;
			}

			.card-img {
			margin-top: -25px;
			background-color: #008bf8;
			width: 220px;
			height: 150px;
			border-radius: .5rem;
			opacity: 1;
			}

			.card-details {
			color: black;
			height: 100%;
			gap: .5em;
			display: grid;
			place-content: center;
			padding: 10px;
			}

			.card-button {
			transform: translate(-50%, 125%);
			width: 60%;
			border-radius: 1rem;
			border: none;
			background-color: #008bf8;
			color: #fff;
			font-size: 1rem;
			padding: .5rem 1rem;
			position: absolute;
			left: 50%;
			bottom: 0;
			opacity: 0;
			transition: 0.3s ease-out;
			cursor: pointer;
			}

			/*Text*/
			.text-body {
			font-size: 1.2em;
			color: rgb(134, 134, 134);
			padding-bottom: 0px;
			margin-bottom: -5px;
			margin-top: 5px;
			}

			.text-title {
			font-weight: 900;
			font-size: 1.4em;
			color: rgb(134, 134, 134);
			letter-spacing: 0.1em;
			margin-bottom: 0;
			padding-bottom: 0px;
			}

			.card-footer {
			width: 100%;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding-top: 10px;
			border-top: 1px solid #ddd;
			color: rgb(134, 134, 134);
			font-size: 1.3em;
			}

			/*Hover*/
			.card:hover {
			border-color: #008bf8;
			box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
			}

			.card:hover .card-button {
			transform: translate(-50%, 50%);
			opacity: 1;
			}
		</style>
</head>
<body>

<link rel="stylesheet" href="style.css">
<div class="login-box" style="margin: 0 auto; left: 50%; transform: translate(-50%, 0); top: 10vh; width: 1400px;">
<a href="updateReservation.php?id=<?php echo $reservation_id ?>" style="color:white">Back to Update Page</a><br><br>
 <h1 style="color:white">Update Car</h1>
 <h3>Your Car:</h3>
	<table class="update-table">
		<tr>
			<th style="border: 1px solid white;">Reservation ID</th>
			<th style="border: 1px solid white;">Car</th>
			<th style="border: 1px solid white;">Start date</th>
			<th style="border: 1px solid white;" >End date</th>
		</tr>
		<tr>
			<td><?php echo $reservation_id; ?></td>
			<td><?php echo $reservation_data['car_name']; ?> (<?php echo $reservation_data['car_colour']?>)</td>
			<td><?php echo $reservation_data['start_date']; ?></td>
			<td><?php echo $reservation_data['end_date']; ?></td>
		</tr>
	</table>
	<div id="box">
		<br><br><h2 style="letter-spacing: 4px;">Select Your New Car</h2>
		<?php
		// Connect to the database to obtain car_names
		$conn = mysqli_connect("localhost", "root", "", "DAI Coursework");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Query the database for car_names
		$sql = "SELECT `car_model_id`, `car_type_id`, `car_name`, `car_colour`, `price_per_day` FROM `Car` WHERE 1";
		$result = mysqli_query($conn, $sql);

		?>
		
		<div class='card-grid'>
		<?php
			$i = 0;
			// Loop over the query results and output the cards
			while ($row = mysqli_fetch_assoc($result)) {
				// Check if the current row's car_name matches the reservation data's car_name
				if ($row["car_name"] === $reservation_data['car_name']) {
					continue; // skip this iteration of the loop
				}
				// Get the image file name from the car name and set the path
				$image_file = strtolower($row["car_name"]) . ".jpg";
				$image_path = "carimages/" . $image_file;
			
				// Output the card HTML
				echo "<div class='card'>
						<div class='card-details'>
							<img class='card-img' src='" . $image_path . "' alt='" . $row["car_name"] . "''>
							<p class='text-title'>{$row["car_name"]}</p>
							<p class='text-body'>Colour: {$row["car_colour"]}</p>
							<b><p class='card-footer'>RM {$row["price_per_day"]} per day</p></b>
						</div>
						<a href='updateReservationCarChooseDate.php?car_model_id=" . $row["car_model_id"] . "&reservation_id=" . $reservation_data["reservation_id"] ."'>
							<button class='card-button'>More info</button>
						</a>
						</div>";
			
				// Increment the counter
				$i++;
			
				// Check if we've outputted four cards in this row
				if ($i % 4 == 0) {
					// If so, close the current row and start a new one
					echo "</div><div class='card-grid'>";
				}
			}
			
			// If there are any cards left over, close the final row
			if ($i % 4 != 0) {
				echo "</div>";
			}			
		?>
		</div>
	</div>
	</div>
</body>
</html>