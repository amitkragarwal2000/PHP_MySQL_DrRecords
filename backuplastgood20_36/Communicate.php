<?php
//Starts the session to use session variables
session_start();
//Check to see if they are logged in
//if user not logged in go to the index page
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
//Connection string to database
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
//Check to see if any problem connecting to DB
if (mysqli_connect_errno())
{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//begin patient Page
if($_SESSION[User_type] == "Patient")
{
	//Begins send message to doctor HTML code
	echo"<h2><div id='title'>Send Message To Doctor<div></h2>
		<br><br>
		<form method='post' action='SendMessageToDoctor'>
		Select Name: <select name='doctorName'>";
	//query to select all doctor names and license numbers
	$query= "SELECT DISTINCT First_name, Last_name, License_number FROM Doctor";
	//execute the query with the database
	$result = mysqli_query($con,$query);
	// while loop grabs each of the row results
	while($row = mysqli_fetch_array($result))
	{
		//variable to select the first name value for the current Doctor
		$dFName = $row['First_name'];
		//variable to select the last name value for the current Doctor
		$dLName = $row['Last_name'];
		//variable to select the license number value for the current Doctor
		$license = $row['License_number'];
		//prints the doctor as an option in HTML
		echo "<option value='$license'>Dr. $dFName $dLName</option>";
	}
	//ends the select, Also creates the text area box for the message and the submit button
	echo "</select>
		<br><br>
		<textarea name='message' cols='25' rows='5'>Enter your message here...</textarea>
		<br><br>
		<input type='submit' name='submit' value='Send Message'> 
	      <br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/' target='_self'>back</a>";
}
//if user is a doctor
if($_SESSION[User_type] == "Doctor")
{
	//Begins send message to doctor HTML code 
	echo"<h2><div id='title'>Send Message To Doctor<div></h2>
		<br><br>
		<form method='post' action='CommunicatesWith'>
		Select Name: <select name='doctorName'>";
	//query to select all doctor names and license numbers
	$query= "SELECT DISTINCT First_name, Last_name, License_number FROM Doctor";
	//execute the query with the database
	$result = mysqli_query($con,$query);
	// while loop grabs each of the row results
	while($row = mysqli_fetch_array($result))
	{
		//variable to select the first name value for the current Doctor
		$dFName = $row['First_name'];
		//variable to select the last name value for the current Doctor
		$dLName = $row['Last_name'];
		//variable to select the license number value for the current Doctor
		$license = $row['License_number'];
		//prints the doctor as an option in HTML
		echo "<option value='$license'>Dr. $dFName $dLName</option>";
	}
	//ends the select, Also creates the text area box for the message and the submit button
	echo "</select>
		<br><br>
		<textarea name='message' cols='25' rows='5'>Enter your message here...</textarea>
		<br><br>
		<input type='submit' name='submit' value='Send Message'> 
	    <br><br></form>";
	//send message to Patient
	echo "<h2><div id='title'>Send Message To Patient<div></h2>
	  	<br><br>
	  	<form method='post' action='SendMessageToPatient'>
	 	Select Name: <select name='patientName'>";
	//query to select all the names and home phone numbers from patient
	$query= "SELECT DISTINCT Name, Home_phone FROM Patient";
	//execute the query with the database
	$result = mysqli_query($con,$query);
  	// while loop grabs each of the row results
  	while($row = mysqli_fetch_array($result))
	{
		//variable to select the Name value of the current patient 
	  	$name = $row['Name'];
		//variable to select the Home_phone value of the current patient 
	  	$phone = $row['Home_phone'];
		//displays the option for a patient and their phone number
		echo "<option value='$name@$phone'>$name $phone</option>";
	}
	//ends the select, Also creates the text area box for the message and the submit button
	echo "</select>
	  	<br><br>
	  	<textarea name='message' cols='25' rows='5'>Enter your message here...</textarea>
	  	<br><br>
	  	<input type='submit' name='submit' value='Send Message'> 
	  	<br><br></form><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/' target='_self'>back</a>";
}	
//closes the sql connection
mysqli_close($con);
?>