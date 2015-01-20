<?php	
//begin code for submitting the form for the doctors communicating with each other
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//starts the session if the request to a page is a POST
	session_start();
	//Connection string to database
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//creates a value for the current date time
	$date = date('Y/m/d H:i:s');
	//creates query to insert values into communicates with
	$query = 
		" INSERT INTO Communicates_With 
				(Doctor_license_one, 
				 Doctor_license_two, 
				 Date_time, 
				 Content, 
				 Status) 
			  VALUES 
			  	($_POST[doctorName], 
				 '$_SESSION[License_number]', 
				 '$date', 
				 '$_POST[message]', 
				 0)
				 ";
	//checks to see if the query successfully runs and runs it
	if (!mysqli_query($con,$query))
	{
		die('Error: ' . mysqli_error($con));
	}
	//closes the sql connection
	mysqli_close($con);
}
//if the request method is not a post then redirects user to index page
else
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
//returns user to homepage
header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");

?>