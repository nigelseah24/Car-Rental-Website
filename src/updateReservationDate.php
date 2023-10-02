<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //get car model id and car name from session
    $car_model_id = $_GET["car_model_id"];
    $car_name = $_GET["car_name"];
    $car_colour = $_GET["car_colour"];

    //get start date and end date from session
    $start_date = $_GET["start_date"];
    $end_date = $_GET["end_date"];

    //get reservation id from previous page
    $old_reservation_id = $_GET["id"];

    // Retrieve the car data from the database that is not booked on the same date
    $car_data_query = "SELECT Car.car_name, Reservation.start_date, Reservation.end_date FROM Reservation INNER JOIN Car ON Car.car_model_id = Reservation.car_model_id WHERE Reservation.start_date <> '$start_date' AND Reservation.end_date <> '$end_date' AND Reservation.car_model_id = '$car_model_id' ORDER BY Reservation.start_date ASC";
    $car_data_result = mysqli_query($con, $car_data_query);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was submitted in the form
        $new_start_date = $_POST['new_start_date'];
        $new_end_date = $_POST['new_end_date'];
        $cust_name = $customer_data['customer_name'];
        $cust_id_number = $customer_data['customer_id_number'];
        $cust_number = $customer_data['customer_number'];

        //check if car is available on the date selected
        $car_date_query = "SELECT start_date, end_date FROM Reservation WHERE car_model_id = '$car_model_id' AND (start_date = '$new_start_date' OR end_date = '$new_end_date')";
        $car_date_result = mysqli_query($con, $car_date_query);

        if($new_start_date == $start_date && $new_end_date == $end_date){
            echo "<script>alert('You have not changed the date. Please select another date.'); window.location.href='updateReservationDate.php?id=$old_reservation_id&car_name=$car_name&car_model_id=$car_model_id&start_date=$start_date&end_date=$end_date'</script>";
        }
        else if(mysqli_num_rows($car_date_result) > 0){
            echo "<script>alert('Car not available from $new_start_date to $new_end_date. Please select another date.'); window.location.href='updateReservationDate.php?id=$old_reservation_id&car_name=$car_name&car_model_id=$car_model_id&start_date=$start_date&end_date=$end_date'</script>";
        } 

        else if(!empty($new_start_date) && !empty($new_end_date)) {
            $reservation_update_query = "UPDATE Reservation SET start_date = '$new_start_date', end_date = '$new_end_date' WHERE reservation_id = '$old_reservation_id' AND car_model_id = '$car_model_id'";
            $reservation_update_result = mysqli_query($con, $reservation_update_query);

            if ($reservation_update_result) {
                echo "<script>alert('Car booking date updated!'); window.location.href='customerIndex.php'</script>";
            } else {
                echo "<script>alert('There was an error updating the booking date.')</script>";
            }
        }
            
        die;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Car Reservation</title>
    <link rel="stylesheet" href="style.css">
    <div class="login-box" style="width: 620px;">
	<div id="box">

    <style>
        table {
        width: 80%;
        margin: 0 auto;
        color: white;
        background: linear-gradient(to left,#4ca1af, #c4e0e5);
        box-shadow: 0px 0px 5px #ccc;
        border: none;
        border-radius: 5px;
        }

        th, td {
        padding: 10px;
        text-align: center;
        }

        h3 {
        text-align: center;
        color: white;
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        background-color: lightblue;
        box-shadow: 0px 0px 5px #ccc;
        border: none;
        border-radius: 5px;
        padding: 10px;
        }

        .centers {
	    text-align: center;
        }
    </style>

    <script>
    function validateDates() {
        var start_date = new Date(document.getElementById("new_start_date").value);
        var end_date = new Date(document.getElementById("new_end_date").value);
        if (end_date < start_date) {
            alert("End date must be after start date.");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>

<a href="updateReservation.php?id=<?php echo $old_reservation_id;?>" style="color: white;">Back to Update Reservation Page</a><br>
	<br>
	<div id="box">
        <h1><?php echo $car_name?></h1>
        <h2>Colour: <?php echo $car_colour?></h2>
        <?php 
            $header_printed = false; // initialize boolean flag
            if(mysqli_num_rows($car_data_result) > 0) {
                // if there is data in $car_data_result, print the table(s)
                while($car_data = mysqli_fetch_assoc($car_data_result))
                {
                    $car_name = $car_data['car_name'];
                    $date_unavailable = $car_data['start_date'] . " - " . $car_data['end_date'];
                    
                    if(!empty($date_unavailable)) {
                        // if date_unavailable is not empty, print the table with the unavailable dates
                        if(!$header_printed) { // print the header only if it hasn't been printed yet
                            ?>
                            <table style="border: 1px solid white;">
                                <tr>
                                    <td style="border: 1px solid white"><strong> Date(s) Unavailable </strong></td>
                                </tr>
                            <?php
                            $header_printed = true; // set the flag to true after printing the header
                        }
                        ?>
                            <tr>
                                <td style="border: 1px solid white;"><strong><?php echo $date_unavailable ?></strong></td>
                            </tr>
                        <?php 
                    }
                }  
            } 
            
            if(!$header_printed) { // if the header hasn't been printed yet, print the "All dates available" message
                ?>
                <h3>All dates available</h3>
                <?php 
            } else { // close the table tag if it has been opened
                ?>
                </table>
                <?php
            }
        ?>
        <br><h2>Current booking date: <?php echo $start_date . " - " . $end_date ?></h2>
        <form method="post" onsubmit="return validateDates()">
			<h2 style= "text-align: left; letter-spacing: 2px;">Select new dates:</h2>
			<label for="new_start_date" style="font-size: 20px; color: white;">Choose a start date: </label>
			<input type="date" id="new_start_date" name="new_start_date" required style="width: 345px; height: 25px"><br><br>
            <label for="new_end_date" style="font-size: 20px; color: white;">Choose a end date: </label>
			<input type="date" id="new_end_date" name="new_end_date" required style="width: 350px; height: 25px"><br><br>
			
            <div class="centers">
                <button input type="submit" value="Submit Rental">
                Submit Rental
                </button> 
            </div>
            
		</form>
	</div>
</div>
</body>
</html>