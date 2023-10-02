<?php

	include("connection.php");
	include("functions.php");

	// Retrieve the reservation ID from the query string
	$reservation_id = $_GET['id'];

	// Retrieve the reservation data from the database
	$reservation_data_query = "SELECT * FROM Reservation, Car where (Reservation.reservation_id = '$reservation_id') && (Reservation.car_model_id = Car.car_model_id) limit 1";
	$reservation_data_result = mysqli_query($con, $reservation_data_query);
	$reservation_data = mysqli_fetch_assoc($reservation_data_result);

	if (isset($_POST['delete'])) {
		// User clicked the "Yes" input, so delete the reservation
		$cancel_reservation_query = "DELETE FROM Reservation WHERE reservation_id = '$reservation_id'";
		mysqli_query($con, $cancel_reservation_query);
		echo "<script>alert('Reservation cancelled!'); window.location.href='customerIndex.php'</script>";
		exit;
	} else if (isset($_POST['confirm']) && $_POST['confirm'] == 'No') {
		// User clicked the "No" input, so redirect back to customerIndex.php
		header('Location: customerIndex.php');
		exit;
	}
	
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Reservation</title>
	<link rel="stylesheet" href="style.css">
	<div id="box">
    <div class="login-box">
	<style> 
			p {
			color: white;
			font-size: 21px;
			margin-bottom: 10px;
			}

			.confirmation-message {
  			border: 1px solid white;
			background: linear-gradient(to left,#4ca1af, #c4e0e5);
			border-radius: .5rem;
			opacity: 1;
			transition: opacity 0.3s ease;
			padding: 10px;
			}

			.button-container {
				display: flex;
				justify-content: center;
				margin-top: 10px;
			}

			button {
				margin: 0 30px;
			}

			/*Hover*/

			.confirmation-message:hover {
			border-color: #008bf8;
			box-shadow: rgba(0, 255, 255, 0.25) 0px 13px 47px -5px, rgba(180, 71, 71, 0.3) 0px 8px 16px -8px;
			}

	</style>
</head>
<body>
	<h1>Delete Reservation</h1>
	<div class="confirmation-message">
	<p>Reservation ID: <?php echo $reservation_id; ?></p>
	<p>Car name: <?php echo $reservation_data['car_name']; ?></p>
	<p>Start date: <?php echo $reservation_data['start_date']; ?></p>
	<p>End date: <?php echo $reservation_data['end_date']; ?></p>
	</div>

	<form method="post" action="">
		<input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">

		<p><strong>Are you sure you want to delete this reservation?</strong></p>

		<div class="button-container">
			<button input type="submit" value="Yes" name="delete">
				Yes
			</button>
			
			<button input type="submit" value="No" name="confirm" style= "width: 81px;">
				No
			</button>
		</div>

	</form>
</body>
</div>
</html>
