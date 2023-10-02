<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Avis Motors</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="style.css">
        
        <!-- favicon -->
        <link rel="shortcut icon" href="Images/logo.jpg" type="image/svg+xml">

        <!-- custom js link -->
        <script src="script.js"></script>

        <!-- Google font effect -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire">

        <link rel="stylesheet" href="https://fonts.google.com/specimen/Manrope">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

        <!-- Google font style -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

        <style>

        .column img:hover {
            opacity: 0.5;
        }

        p{
            color: white;
        }

        .container {
        display: flex;
        flex-wrap: wrap;
        /* margin-left: 245px; Backup */
        margin-left: auto;
        }

        .column {
        flex: 1;
        margin: 10px;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
        width: 15px;
        height: 10px;
        }

        ::-webkit-scrollbar-track {
        background: hsl(0, 0%, 100%);
        }

        ::-webkit-scrollbar-thumb {
        background: hsl(0, 0%, 30%);
        border: 2px solid hsl(0, 0%, 100%);
        }

        ::-webkit-scrollbar-thumb:hover { background: hsl(0, 0%, 40%); }

        /* Test for header animation */
        

        h2 {
        text-align: center;
        color: white;
        transition: color 2s ease-out 25ms;
        font-family: 'Manrope', sans-serif;
        }

        h2:hover{
            color:#6045ea;
        }

        .img-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
        border: 2px solid #ddd;
        transition: border-color 0.3s ease-in-out;
        }

        /*Border color/animation when hover*/
        .img-container:hover {
        border-color: #8567f7;
        border-width: 3.2px;
        }

        .img-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        text-align: center;
        color: white;
        font-family: 'Trirong', serif;
        }

        .img-container:hover .img-overlay {
        opacity: 1;
        }

        img {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: auto;
        margin-bottom: 10px;
        }

        .description {
        text-align: center;
        margin-top: 10px;
        font-size: 16px;
        /* font-weight: bold; */
        color: white;
        }

        .book-now {
        position: absolute;
        bottom: 50px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #8567f7;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        }

        .img-container:hover .book-now {
        opacity: 1;
        }

        @media screen and (max-width: 767px) {
        .column {
            flex: 100%;
        }
        }

        /* Remove link underline */
        a:link { text-decoration: none; }
        a:visited { text-decoration: none; }
        a:hover { text-decoration: none; }
        a:active { text-decoration: none; }

        </style>

    </head>

    <body>

        <?php include 'header.php';?>

        <h1 style="text-align: center; color:white; font-family: 'Sofia', sans-serif; font-size: 2.8em;">Featured Cars</h1>

        <br>

        <!--All Luxurious Cars-->

        <div class="container">
        <div class="column">

            <h2 class="font-effect-emboss">Luxurious Car</h2>

            <?php
            // Connect to the database to obtain car_names
            $conn = mysqli_connect("localhost", "root", "", "DAI Coursework");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query the database for car_names
            $sql = "SELECT `car_model_id`, `car_type_id`, `car_name`, `car_colour`, `price_per_day` FROM `Car` WHERE car_type_id='LUX'";
            $result = mysqli_query($conn, $sql);

			// Loop over the query results and output the cards
			while ($row = mysqli_fetch_assoc($result)) {
			// Get the image file name from the car name and set the path
			$image_file = strtolower($row["car_name"]) . ".jpg";
			$image_path = "Images/" . $image_file;

			// Output the card HTML
			echo "<div class='img-container'>
						<img class='card-img' src='" . $image_path . "' alt='" . $row["car_name"] . "''>
                        <div class='img-overlay'>{$row["car_name"]}<br></div>
                        <div class='description'>RM{$row["price_per_day"]}/ day </div>						
                        <a href='staffLogin.php' class='book-now'>Book Now</a>
					</div>";
            }
		    ?>

        </div>
        <div class="column">

            <h2 class="font-effect-emboss">Sports Car</h2>

            <?php
            // Connect to the database to obtain car_names
            $conn = mysqli_connect("localhost", "root", "", "DAI Coursework");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query the database for car_names
            $sql = "SELECT `car_model_id`, `car_type_id`, `car_name`, `car_colour`, `price_per_day` FROM `Car` WHERE car_type_id='SPRTS'";
            $result = mysqli_query($conn, $sql);

			// Loop over the query results and output the cards
			while ($row = mysqli_fetch_assoc($result)) {
			// Get the image file name from the car name and set the path
			$image_file = strtolower($row["car_name"]) . ".jpg";
			$image_path = "Images/" . $image_file;

			// Output the card HTML
			echo "<div class='img-container'>
						<img class='card-img' src='" . $image_path . "' alt='" . $row["car_name"] . "''>
                        <div class='img-overlay'>{$row["car_name"]}<br></div>
                        <div class='description'>RM{$row["price_per_day"]}/ day </div>						
                        <a href='staffLogin.php' class='book-now'>Book Now</a>
					</div>";
            }
		?>

        </div>
        <div class="column">

            <h2 class="font-effect-emboss">Classics Car</h2>

            <?php
            // Connect to the database to obtain car_names
            $conn = mysqli_connect("localhost", "root", "", "DAI Coursework");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query the database for car_names
            $sql = "SELECT `car_model_id`, `car_type_id`, `car_name`, `car_colour`, `price_per_day` FROM `Car` WHERE car_type_id='CLCS'";
            $result = mysqli_query($conn, $sql);

			// Loop over the query results and output the cards
			while ($row = mysqli_fetch_assoc($result)) {
			// Get the image file name from the car name and set the path
			$image_file = strtolower($row["car_name"]) . ".jpg";
			$image_path = "Images/" . $image_file;

			// Output the card HTML
			echo "<div class='img-container'>
						<img class='card-img' src='" . $image_path . "' alt='" . $row["car_name"] . "''>
                        <div class='img-overlay'>{$row["car_name"]}<br></div>
                        <div class='description'>RM{$row["price_per_day"]}/ day </div>						
                        <a href='staffLogin.php' class='book-now'>Book Now</a>
					</div>";
            }
		?>

        </div>
        </div>

        <?php include "footer.php"?>

    </body>
</html>