<?php 
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$cust_id_number = $_POST['cust_id_number'];

		if(!empty($cust_id_number))
		{
			//read from database
			$query = "select * from Customer where customer_id_number = '$cust_id_number' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$customer_data = mysqli_fetch_assoc($result);
					echo $customer_data['customer_id_number'];
					
					if($customer_data['customer_id_number'] === $cust_id_number)
					{
						$_SESSION['customer_id_number'] = $customer_data['customer_id_number'];
						header("Location: customerIndex.php");
						die;
					}
				}
			}
			
			echo "<p style='color: white;'>wrong ID number!</p>";
		}else
		{
			echo "<p style='color: white;'>wrong ID number!</p>";
		}
	}
# 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
	<style>
	.centers {
	text-align: center;
	}
	</style>

</head>
<body>

	<link rel="stylesheet" href="style.css">
	<div class="login-box">

	<br>

    <br><h2>Customer Login</h2>
	<div id="box">
		<form method="post">
	
			<div class="user-box">
				<input type="text" name="cust_id_number" required maxlength="12" required pattern="\d{12}">
				<label>Enter customer ID number (12 digits):</label>
			</div>

			<div class="centers">
				<button type="submit" id="button">
				Login
				</button>
				<a href="index.php">Back to Main Page</a>
			</div>
		</form>
	</div>
</body>
</html>