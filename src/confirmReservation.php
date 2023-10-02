<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //get car model id from session
    $car_model_id = $_GET["car_model_id"];
    $car_name_query = "SELECT * FROM Car WHERE car_model_id = '$car_model_id' LIMIT 1";
    $car_name_result = mysqli_query($con, $car_name_query);
    $car_name = mysqli_fetch_assoc($car_name_result);

    //get car reserved date in ascending order and car name to output into table
    $car_data_query = "SELECT Car.car_name, Reservation.start_date, Reservation.end_date FROM Reservation, Car WHERE (Car.car_model_id = Reservation.car_model_id AND Reservation.car_model_id = '$car_model_id') ORDER BY Reservation.start_date ASC";
    $car_data_result = mysqli_query($con, $car_data_query);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was submitted in the form
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $cust_name = $_POST['cust_name'];
        $cust_id_number = $_POST['cust_id_number'];
        $cust_number = $_POST['cust_number'];

        //get staff id from session
        $staff_id = $_SESSION['staff_id'];
        $staff_query = "SELECT * FROM Staff WHERE staff_id = '$staff_id' LIMIT 1";
        $staff_result = mysqli_query($con, $staff_query);

        //check if customer id number already exists
        $customer_query = "SELECT * FROM Customer WHERE customer_id_number = '$cust_id_number'";
        $customer_result = mysqli_query($con, $customer_query);
        $customer_data = mysqli_fetch_assoc($customer_result);

        //check if car is available on the date selected
        $car_date_query = "SELECT start_date, end_date FROM Reservation WHERE car_model_id = '$car_model_id' AND (start_date BETWEEN '$start_date' AND '$end_date' OR end_date BETWEEN '$start_date' AND '$end_date')";
        $car_date_result = mysqli_query($con, $car_date_query);

        if(mysqli_num_rows($car_date_result) > 0){
            echo "<script>alert('Car not available on the date selected. Please select another date.'); window.location.href='confirmReservation.php?car_model_id=$car_model_id&cust_name=$cust_name&cust_id_number=$cust_id_number&cust_number=$cust_number&start_date=$start_date&end_date=$end_date'</script>";
        } 
        else if($cust_id_number == $customer_data['customer_id_number']) {
            echo "<script>alert('Customer ID number already exists. Please enter another ID number.'); window.location.href='confirmReservation.php?car_model_id=$car_model_id&cust_name=$cust_name&cust_id_number=$cust_id_number&cust_number=$cust_number&start_date=$start_date&end_date=$end_date'</script>";
        }
        else if(!empty($car_model_id) && !empty($start_date) && !empty($end_date) && !empty($cust_name) && !empty($cust_id_number) && !empty($cust_number)) {
            if($staff_result) {
                if($staff_result && mysqli_num_rows($staff_result) > 0) {



                    $staff_data = mysqli_fetch_assoc($staff_result);

                    //car_type_id (LUXURY, SPORTS, CLASSIC) is used to generate reservation_id
                    $car_type_query = "SELECT car_type_id FROM Car WHERE car_model_id = '$car_model_id' LIMIT 1";
                    $car_type_result = mysqli_query($con, $car_type_query);
                    $car_type_id = mysqli_fetch_assoc($car_type_result);
                    $reservation_id = $car_type_id['car_type_id'] . random_num(2);
                    
                    // Start the transaction to ensure that both queries succeed (due to foreign keys)
                    mysqli_begin_transaction($con);

                    $reservation_query = "INSERT INTO Reservation (reservation_id, staff_id, car_model_id, start_date, end_date) VALUES ('$reservation_id', '{$staff_data['staff_id']}','$car_model_id','$start_date', '$end_date')";
                    $reservation_result = mysqli_query($con, $reservation_query);
                    $customer_query = "INSERT INTO Customer (customer_name,customer_id_number,customer_number,reservation_id) VALUES ('$cust_name','$cust_id_number','$cust_number','$reservation_id')";
                    $customer_result = mysqli_query($con, $customer_query);

                    if ($reservation_result && $customer_result) {
                        // Commit the transaction if both queries succeed
                        mysqli_commit($con);
                        echo "<script>alert('Car booked! Reservation ID: $reservation_id'); window.location.href='index.php'</script>";
                    } else {
                        // Rollback the transaction if any query fails
                        mysqli_rollback($con);
                    }
                }
            }
        }	
            
        die;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Reservation</title>
    <style>
        table {
        width: 80%;
        margin: 0 auto;
        color: white;
        background-color: lightblue;
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
        var start_date = new Date(document.getElementById("start_date").value);
        var end_date = new Date(document.getElementById("end_date").value);
        if (end_date < start_date) {
            alert("End date must be after start date.");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
    <link rel="stylesheet" href="style.css">
	<div id="box">
    <div class="login-box" style="left: 50%; transform: translate(-50%, 0); top: 10vh; width: 600px;">
        <h1><?php echo $car_name['car_name'] ?></h1>
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
                            <table style="width: 80%; margin: 0 auto; font-size: 1.2em; color: white;">
                                <tr>
                                    <td style="border: 1px solid white;"> 
									<strong>Date(s) Unavailable</strong> </td>
                                </tr>
                            <?php
                            $header_printed = true; // set the flag to true after printing the header
                        }
                        ?>
                            <tr>
                                <td style="border: 1px solid white;"><?php echo $date_unavailable ?></td>
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
        <br><h2>Create new Reservation</h2>

            <div class="user-box">
            <input type="text" name="cust_name" required="">
			<label>Enter customer name: </label>
            </div>

            <div class="user-box">
            <input type="text" name="cust_number" required maxlength="10" required pattern="\d{10}">
			<label>Enter customer phone number (max 10 digits): </label>
            </div>

            <div class="user-box">
            <input type="text" name="cust_id_number" required maxlength="12" required pattern="\d{12}">
			<label>Enter customer ID number (12 digits): </label>
            </div>

            <div class="user-box">
            <br><input type="date" name="start_date" required="">
			<label>Choose a start date: </label>
            </div>

            <div class="user-box">
            <br><input type="date" name="end_date" required="">
			<label>Choose a end date: </label>
            </div>

            <div class="centers">
            <button type="submit" name="button">
			Submit Rental
			</button>
			<br><a href="createReservation.php">Select a Different Car</a>
        </div>
	</form>
    </div>
    </div>
</body>
</html>