<?php
//starts the session
session_start();
//if user not valid send them to the login page
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
else
{
	//connection string to DB
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//Check to see if any problem connecting to DB
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//checks to see if user is a patient
	if($_SESSION[User_type] == "Patient")
	{
		//query to see if there are unread messages for patient
		$query = "SELECT 
					COUNT(Status) AS 'unread' 
					FROM Sends_Message_To_Patient 
					WHERE 
						(Patient_name = '$_SESSION[Name]' 
							AND Patient_home_phone = '$_SESSION[Home_phone]' 
							AND Status=0)
							";
		//gets results of query
		$result = mysqli_query($con,$query);
		//gets the data from the result of the query
		$row = mysqli_fetch_array($result);
		//saves the unread messages count to a variable
		$unread = $row['unread'];
		echo "<html><body><h1>Homepage for Patient</h1>";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Appointment' target='_self'>Make Appointments</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/VisitHistory' target='_self'>View Visit History</a> ";
		//if there are unread messages show a link to Messages
		if ($unread != 0)
		{
			echo "<a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Messages' style='color: rgb(255,0,0)' target='_self'> You have $unread unread messages</a>";
		}
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/OrderMedication' target='_self'>Order Medications</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Communicate' target='_self'>Communicate</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/RateDoctor' target='_self'>Rate a Doctor</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/EditProfile' target='_self'>Edit Profile</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Messages' target='_self'>Messages</a> ";
		echo "<br><br><form action='Logout'>
  <input type='submit'  value='Logout'>
</form>";
	}
	//if a user is a doctor
	if($_SESSION[User_type] == "Doctor")
	{
		//query to see if there are unread messages for doctor from patients
		$query3 = "SELECT 
					COUNT(Status) as 'unread' 
					FROM Sends_Message_To_Doctor 
					WHERE (Doctor_license_number = '$_SESSION[License_number]' 
					AND Status=0)
					";
		//get results from the query
		$result3 = mysqli_query($con,$query3);
		//gets the data from the result
		$row3 = mysqli_fetch_array($result3);
		//query to see if there are unread messages for doctor from patients
		$query2 = "SELECT 
					COUNT(Status) as 'unread' 
					FROM Communicates_With 
					WHERE (Doctor_license_two = '$_SESSION[License_number]' 
					AND Status=0)
					";
		//get results from the query
		$result2 = mysqli_query($con,$query2);
		//gets the data from the result
		$row2 = mysqli_fetch_array($result2);
		//saves number of unread messages in unread variable
		$unread2 = $row3['unread'] + $row2['unread'];
		echo "<html><body><h1>Homepage for Doctor</h1>";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/AppointmentCalendar' target='_self'>View Appointments Calendar</a> ";
		if ($unread2 != 0)
		{
			echo "<a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Messages' style='color: rgb(255,0,0)' target='_self'> You have $unread2 unread messages</a>";
		}
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/PatientVisitHistory' target='_self'>Patient Visits</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/RecordSurgery' target='_self'>Record a surgery</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Communicate' target='_self'>Communicate</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/EditProfile' target='_self'>Edit Profile</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Messages' target='_self'>Messages</a> ";
		echo "<br><br><form action='Logout'>
  <input type='submit'  value='Logout'>
</form>";
	}
		//if a user is an Admin
	if($_SESSION[User_type] == "Administrative_Personnel")
	{
		echo "<html><body><h1>Homepage</h1>";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Billing' target='_self'>Billing</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/DoctorPerformanceReport' target='_self'>Doctor Performance Report</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/SurgeryReport' target='_self'>Surgery Report</a> ";
		echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/PatientVisitReport' target='_self'>Patient Visit Report</a> ";
		echo "<br><br><form action='Logout'>
  <input type='submit'  value='Logout'>
</form>";
	}
}
?>




</body>
</html>