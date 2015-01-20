<?php
	session_start();
	if($_SESSION[username] == "")
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/");
	}
	else
	{
		if($_SESSION[User_type] == "Patient")
		{
			echo "<html><body><h1>Homepage for Patient</h1>";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Appointment' target='_self'>Make Appointments</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/VisitHistory' target='_self'>View Visit History</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Order' target='_self'>Order Medications</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Communicate' target='_self'>Communicate</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Rate' target='_self'>Rate a Doctor</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/EditProfile' target='_self'>Edit Profile</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Messages' target='_self'>Messages</a> ";
		}
		if($_SESSION[User_type] == "Doctor")
		{
			echo "<html><body><h1>Homepage for Doctor</h1>";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/AppointmentCalendar' target='_self'>View Appointments Calendar</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/PatientVisits' target='_self'>Patient Visits</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/RecordSurgery' target='_self'>Record a surgery</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Communicate' target='_self'>Communicate</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/EditProfile' target='_self'>Edit Profile</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Messages' target='_self'>Messages</a> ";
		}
		if($_SESSION[User_type] == "Administrative_Personnel")
		{
			echo "<html><body><h1>Homepage</h1>";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Billing' target='_self'>Billing</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/DoctorPerformanceReport' target='_self'>Doctor Performance Report</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/SurgeryReport' target='_self'>Surgery Report</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/PatientVisitReport' target='_self'>Patient Visit Report</a> ";
			echo "<br><br><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Messages' target='_self'>Messages</a> ";
	}
}
?>




</body>
</html>