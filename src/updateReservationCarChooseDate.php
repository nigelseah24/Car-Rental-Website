<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //get car model id from session
    $car_model_id = $_GET["car_model_id"];
    $car_name_query = "SELECT * FROM Car WHERE car_model_id = '$car_model_id' LIMIT 1";
    $car_name_result = mysqli_query($con, $car_name_query);
    $car_name = mysqli_fetch_assoc($car_name_result);

    //get reservation id from previous page
    $old_reservation_id = $_GET["reservation_id"];

    //get customer data from reservation id
    $customer_data_query = "SELECT * FROM Reservation, Customer WHERE (Reservation.reservation_id = '$old_reservation_id') && (Reservation.reservation_id = Customer.reservation_id) limit 1";
    $customer_data_result = mysqli_query($con, $customer_data_query);
    $customer_data = mysqli_fetch_assoc($customer_data_result);

    //get car reserved date in ascending order and car name to output into availability table
    $car_data_query = "SELECT Car.car_name, Reservation.start_date, Reservation.end_date FROM Reservation, Car WHERE (Car.car_model_id = Reservation.car_model_id AND Reservation.car_model_id = '$car_model_id') ORDER BY Reservation.start_date ASC";
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

        if(mysqli_num_rows($car_date_result) > 0){
            echo "Car not available from $new_start_date to $new_end_date. <br><br>Please select another date.";
            echo "<br><br><a href='updateReservationCarChooseDate.php?car_model_id=$car_model_id&reservation_id=$old_reservation_id'><u>Click here to update date for your <strong>{$car_name['car_name']}</strong> again.</u></a>";
        } 
        else if(!empty($car_model_id) && !empty($new_start_date) && !empty($new_end_date)) {
            //car_type_id (LUXURY, SPORTS, CLASSIC) is used to generate reservation_id
            $car_type_query = "SELECT car_type_id FROM Car WHERE car_model_id = '$car_model_id' LIMIT 1";
            $car_type_result = mysqli_query($con, $car_type_query);
            $car_type_id = mysqli_fetch_assoc($car_type_result);
            $new_reservation_id = $car_type_id['car_type_id'] . random_num(2);
            
            // Start the transaction to ensure that both queries succeed (due to foreign keys)
            mysqli_begin_transaction($con);

            #$reservation_update_query = "INSERT INTO Reservation (reservation_id, staff_id, car_model_id, start_date, end_date) VALUES ('$new_reservation_id', '{$staff_data['staff_id']}','$car_model_id','$new_start_date', '$new_end_date')";
            $reservation_update_query = "UPDATE Reservation SET reservation_id = '$new_reservation_id', car_model_id = '$car_model_id', start_date = '$new_start_date', end_date = '$new_end_date' WHERE reservation_id = '$old_reservation_id'";
            $reservation_update_result = mysqli_query($con, $reservation_update_query);
            #$customer_update_query = "INSERT INTO Customer (customer_name,customer_id_number,customer_number,reservation_id) VALUES ('$cust_name','$cust_id_number','$cust_number','$reservation_id')";
            $customer_update_query = "UPDATE Customer SET reservation_id = '$new_reservation_id' WHERE (customer_name = '$cust_name') && (customer_id_number = '$cust_id_number') && (customer_number = '$cust_number') && (reservation_id = '$old_reservation_id')";
            $customer_update_result = mysqli_query($con, $customer_update_query);

            if ($reservation_update_result && $customer_update_result) {
                // Commit the transaction if both queries succeed
                mysqli_commit($con);
                echo "<script>
                    alert('Car booking updated!\\nNew reservation ID: " . $new_reservation_id . "');
                    window.location.href='customerIndex.php';
                    </script>";
            } else {
                // Rollback the transaction if any query fails
                mysqli_rollback($con);
                echo "There was an error executing one or both of the queries. The changes were rolled back.";
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
	<div class="login-box" style="transform: translate(-50%, 0); top: 10vh; width: 500px">

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

    <a href="updateReservationCarIndex.php?id=<?php echo $old_reservation_id ?>" style="color:white">Back to Car Selection Page</a><br>	<br>
	<div id="box">
        <h1><?php echo $car_name['car_name']?></h1>
        <h2>Colour: <?php echo $car_name['car_colour']?></h2>
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
                                    <td style="border: 1px solid white;"><strong> Date(s) Unavailable </strong></td>
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
        <form method="post" onsubmit="return validateDates()">
			<br>
            <h2 style= "text-align: left; letter-spacing: 2px;">Select new dates:</h2>
			<label for="new_start_date" style="font-size: 15px; color: white;">Choose a start date:  </label>
			<input type="date" id="new_start_date" name="new_start_date" required style="width: 250px; height: 25px"><br><br>
            <label for="new_end_date" style="font-size: 15px; color: white;">Choose a end date:  </label>
			<input type="date" id="new_end_date" name="new_end_date" required style="width: 255px; height: 25px"><br><br>
			
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