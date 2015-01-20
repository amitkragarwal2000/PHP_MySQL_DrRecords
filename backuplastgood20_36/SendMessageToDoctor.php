<?php	
//begin code for submitting the form
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	session_start();
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	$date = date('Y/m/d H:i:s');
	$query = "INSERT INTO Sends_Message_To_Doctor (Doctor_license_number, Patient_Name, Patient_home_phone, Date_time, Content, Status) VALUES ($_POST[doctorName], '$_SESSION[Name]', '$_SESSION[Home_phone]', '$date', '$_POST[message]', 0 )";
	if (!mysqli_query($con,$query))
	{
		die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
}
else
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");

?>