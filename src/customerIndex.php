<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$customer_data = check_customer_login($con);

    // Query to get all reservations for the customer
    $table_query = "SELECT Reservation.reservation_id, Reservation.start_date, Reservation.end_date, car_name, price_per_day FROM `Customer`, `Reservation`, `Car` WHERE (Customer.reservation_id = Reservation.reservation_id) && (Car.car_model_id = Reservation.car_model_id) && (Customer.customer_id_number = '$customer_data[customer_id_number]')";
    $table_result = mysqli_query($con, $table_query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Reservations</title>
    <link rel="stylesheet" href="style.css">
	<div class="login-box" style="left: 50%; top: 50%; width: 1000px">

    <style>
        table {
        width: 100%;
        margin: 0 auto;
        color: white;
        background: linear-gradient(to left,#4ca1af, #c4e0e5);
        box-shadow: 0px 0px 5px #ccc;
        border: none;
        border-radius: 5px;
        }

        th {
            font-size:20px;
            border: 1px solid white;
        }

        th, td {
        padding: 9px;
        text-align: center;
        }

        p, a {
        letter-spacing: 2px;
        }

    </style>

</head>
<body>

	<a href="index.php" style="color: white;">Customer Logout</a>
	<br><br><h1>Hello, <?php echo $customer_data['customer_name']; ?>.</h1>

    <div>
    <?php 
        if (mysqli_num_rows($table_result) > 0) {
    ?>
        <h2><u>Your Reservations:</u></h2>
        <table>
            <tr>
                <th> Reservation ID </th>
                <th> Car </th>
                <th> Price Per Day </th>
                <th> Start Date </th>
                <th> End Date </th>
            </tr>
            <?php 
                                    
                    while($reservation_data = mysqli_fetch_assoc($table_result))
                    {
                        $reservation_id = $reservation_data['reservation_id'];
                        $car_name = $reservation_data['car_name'];
                        $price_per_day = $reservation_data['price_per_day'];
                        $start_date = $reservation_data['start_date'];
                        $end_date = $reservation_data['end_date'];
            ?>
                    <tr>
                        <td><?php echo $reservation_id ?></td>
                        <td><?php echo $car_name ?></td>
                        <td><?php echo $price_per_day ?></td>
                        <td><?php echo $start_date ?></td>
                        <td><?php echo $end_date ?></td> 

                        <td><a href="updateReservation.php?id=<?php echo $reservation_id ?>" class="btn btn-pencil">Edit</a></td>
                        <td><a href="deleteReservation.php?id=<?php echo $reservation_id ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    </table>    
            <?php 
                    }  
            ?>                          

    <?php 
        } else {
    ?>
            <h2>No reservations found.</h2>
    <?php 
        }
    ?>
    </div><br><br>
    </div>
</body>
</html>