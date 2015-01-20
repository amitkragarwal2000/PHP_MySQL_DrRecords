<?php
//starts the session
session_start();
//if the username is null redirect to login page
if($_SESSION[username] == '')
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
//else continue
else
{
	//connection string for DB
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//if there is an error connecting to the DB show it
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//query to select all values from User
	$query = "SELECT * 
				FROM `User` 
				WHERE `Username` = '$_SESSION[username]' 
				AND `Password` = '$_SESSION[password]'
				";
	//get results from query
	$result = mysqli_query($con, $query);
	//gate data from results
	$result = mysqli_fetch_array($result);
	//if user is an admin
	if($result[User_type] == 'a')
	{
		$_SESSION[User_type] = 'Administrative_Personnel';
		$query = "SELECT Username 
					FROM `Administrative_Personnel` 
					WHERE `Username` = '$_SESSION[username]'
					";
					$result = mysqli_query($con, $query);
					$result = mysqli_fetch_array($result);
					mysqli_close($con);
					if($result[Username] == '') 
					{
						header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
					}
					else
					{
						header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
					}
	}
	//if user is a doctor
	if($result[User_type] == 'd')
	{
		$_SESSION[User_type] = 'Doctor';
		$query = "SELECT Username 
					FROM `Doctor` 
					WHERE `Username` = '$_SESSION[username]'
					";
		$newquery = "SELECT First_name, 
							Last_name, 
							License_number 
						FROM `Doctor` 
						WHERE `Username` = '$_SESSION[username]'
						";
		$newresult = mysqli_query($con, $newquery);
		$newresult = mysqli_fetch_array($newresult);
		$_SESSION[First_name] = $newresult[First_name];
		$_SESSION[Last_name] = $newresult[Last_name];
		$_SESSION[License_number] = $newresult[License_number];
		$result = mysqli_query($con, $query);
		$result = mysqli_fetch_array($result);
		mysqli_close($con);
		if($result[Username] == '') 
		{
			header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/CreateDoctorProfile");
		}
		else
		{
			header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
		}
	}
	//if user is a patient
	if($result[User_type] == 'p')
	{
		$_SESSION[User_type] = 'Patient';
		$query = "SELECT Username 
					FROM `Patient` 
					WHERE `Username` = '$_SESSION[username]'
					";
		$newquery = "SELECT Name, 
							Home_phone 
						FROM `Patient` 
						WHERE `Username` = '$_SESSION[username]'
						";
		$newresult = mysqli_query($con, $newquery);
		$newresult = mysqli_fetch_array($newresult);
		$_SESSION[Name] = $newresult[Name];
		$_SESSION[Home_phone] = $newresult[Home_phone];
		$result = mysqli_query($con, $query);
		$result = mysqli_fetch_array($result);
		mysqli_close($con);
		if($result[Username] == '') 
		{
			header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/CreateProfile");
		}
		else
		{
			header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
		}
	}

}
?>