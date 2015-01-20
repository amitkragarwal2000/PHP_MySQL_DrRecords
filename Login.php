<?php
	session_start();
	if($_SESSION[username] == '')
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/");
	}
	else{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = "SELECT * FROM `User` WHERE `Username` = '$_SESSION[username]' AND `Password` = '$_SESSION[password]'";
	$result = mysqli_query($con, $query);
	$result = mysqli_fetch_array($result);
	if($result[User_type] == 'a')
	{
		$_SESSION[User_type] = 'Administrative_Personnel';
		$query = "SELECT Username FROM `Administrative_Personnel` WHERE `Username` = '$_SESSION[username]'";
	}
	if($result[User_type] == 'd')
	{
		$_SESSION[User_type] = 'Doctor';
		$query = "SELECT Username FROM `Doctor` WHERE `Username` = '$_SESSION[username]'";
	}
	if($result[User_type] == 'p')
	{
		$_SESSION[User_type] = 'Patient';
		$query = "SELECT Username FROM `Patient` WHERE `Username` = '$_SESSION[username]'";
	}
	
	$result = mysqli_query($con, $query);
	$result = mysqli_fetch_array($result);
	mysqli_close($con);
	if($result[Username] == '') 
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/CreateProfile");
	}
	else
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Homepage");
	}
}
	
	
?>