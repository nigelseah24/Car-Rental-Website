<?php

function check_staff_login($con)
{

	if(isset($_SESSION['staff_id']))
	{

		$id = $_SESSION['staff_id'];
		$query = "select * from Staff where staff_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$staff_data = mysqli_fetch_assoc($result);
			return $staff_data;
		}
	}

	//redirect to login
	header("Location: staffLogin.php");
	die;

}

function check_customer_login($con)
{

	if(isset($_SESSION['customer_id_number']))
	{

		$id = $_SESSION['customer_id_number'];
		$query = "select * from Customer where customer_id_number = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$customer_data = mysqli_fetch_assoc($result);
			return $customer_data;
		}
	}

	//redirect to login
	header("Location: customerLogin.php");
	die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}
 
	return $text;
}