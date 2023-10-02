<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$staff_name = $_POST['name'];
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$staff_code = $_POST['code'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			if($staff_code == "1234"){
				//save to database
				$staff_id = "ST" . random_num(5);
				$query = "insert into Staff (staff_id,staff_name,user_name,password) values ('$staff_id','$staff_name','$user_name','$password')";

				mysqli_query($con, $query);

				header("Location: staffLogin.php");
				die;
			}
			else{
				echo "Invalid Staff Code!";
			}

		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<style type="text/css">
		.hyperlink{
  			text-align: right;
  			}
	</style>

</head>
<body>

	<div id="box">
		<div class="login-box">
		<link rel="stylesheet" href="style.css">
			<h2>Create Staff Account</h2>
			<form method="post">
				<div class="user-box">
				<input type="text" name="name" required="">
				<label>Enter your name:</label>
				</div>
				<div class="user-box">
				<input type="text" name="user_name" required="">
				<label>Enter your username:</label>
				</div>
				<div class="user-box">
				<input type="password" name="password" required="">
				<label>Enter your password:</label>
				</div>
				<div class="user-box">
				<input type="text" name="code" required="">
				<label>Enter staff code:</label>
				</div>
				<button type="submit">
				Submit
				</button>
			</form>
			<div class="hyperlink">
			<br><a href="staffLogin.php">Already have an account? Login</a><br><br>
			</div>
	</div>
	</div>
	</body>
</html>