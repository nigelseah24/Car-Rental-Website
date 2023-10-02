<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from Staff where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$staff_data = mysqli_fetch_assoc($result);
					
					if($staff_data['password'] === $password)
					{

						$_SESSION['staff_id'] = $staff_data['staff_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "<p style='color: white;'>wrong username or password!</p>";
		}else
		{
			echo "<p style='color: white;'>wrong username or password!</p>";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" href="style.css">

	<style type="text/css">
		
		.hyperlink {
  			text-align: right;
			color: white;	
		}

		p, a {
			letter-spacing: 1px;
		}
	</style>

</head>
<body>
	<?php include 'header.php';?>

	<div id="box">
	<link rel="stylesheet" href="style.css">
		<style>
			body {
				background-image: url(Images/homeBanner3.jpg);
			}
		</style>
		<div class="login-box">
			<h2>Login</h2>
			<form method="post" id="my-form">
				<div class="user-box">
					<input type="text" name="user_name" required="">
					<label>Username:</label>
				</div>
				<div class="user-box" style="left: 0px; top: 0px">
					<input type="password" name="password" required="">
					<label>Password:</label>
				</div>
				<div style="text-align: center;">
					<a href="#" onclick="document.getElementById('my-form').submit()">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						Book Now
					</a>
				</div>
			</form>
			<div class="hyperlink">
			<br><br><a href="createStaffAccount.php" class="hyperlink">Click to create staff account</a>
			</div>
		</div>
	</div>
	</body>
</html>