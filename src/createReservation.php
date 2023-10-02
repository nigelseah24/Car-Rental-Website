<?php 
session_start();

	include("connection.php");
	include("functions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Reservation</title>
	<style>
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
		padding: 1rem;
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
    <a href="index.php" style="color: white;">Back to Main Page</a>
	<br>
	<div id="box">
		<h1>Select Car</h1>
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
			// Get the image file name from the car name and set the path
			$image_file = strtolower($row["car_name"]) . ".jpg";
			$image_path = "carImages/" . $image_file;

			// Output the card HTML
			echo "<div class='card'>
					<div class='card-details'>
						<img class='card-img' src='" . $image_path . "' alt='" . $row["car_name"] . "''>
						<p class='text-title'>{$row["car_name"]}</p>
						<p class='text-body'>Colour: {$row["car_colour"]}</p>
						<b><p class='card-footer'>RM {$row["price_per_day"]} per day</p></b>
					</div>
					<a href='confirmReservation.php?car_model_id=" . $row["car_model_id"] . "'>
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