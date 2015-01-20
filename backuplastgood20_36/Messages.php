<?php
//starts the users session
session_start();
//if user is not logged in redirect them to index page
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
//else continue
else
{
	//connection string to connect to DB
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//Check to see if any problem connecting to DB
	if (mysqli_connect_errno())
	{
		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if($_SESSION[User_type] == "Patient")
	{
	    $query = "SELECT Doctor_license_number, 
						 Date_time, 
						 Content, 
						 Status 
					FROM Sends_Message_To_Patient 
					WHERE (Patient_name = '$_SESSION[Name]' 
					AND Patient_home_phone = '$_SESSION[Home_phone]') 
					ORDER BY Date_time DESC";
	  $result = mysqli_query($con,$query);
		echo "<h2><div id='title'>Messages<div></h2>
			<br><br>";
		echo "<table border='1'>
		<tr>
		<th>Status</th>
		<th>Date</th>
		<th>From</th>
		<th>Message</th>
		</tr>";
		while($row = mysqli_fetch_array($result))
		  {
			  $docQuery = "SELECT First_name, Last_name FROM Doctor WHERE License_number = $row[Doctor_license_number]";
	  	 	  $docName = mysqli_query($con,$docQuery);
			  $docName = mysqli_fetch_array($docName);
			  $read = "Unread";
			  if ($row['Status'] == 1)
			  {
			  	$read = "Read";
			  }
		  echo "<tr>";
		  echo "<td>$read<br></td>";
		  echo "<td> " . $row['Date_time'] . "<br></td>";
		  echo "<td> Dr. " . $docName['First_name'] . " "  . $docName['Last_name'] . "<br></td>";
		  echo "<td> " . $row['Content'] . "<br></td>";
		  echo "</tr>";
		  }
		echo "</table><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/' target='_self'>back</a>";
	    $query2 = "UPDATE Sends_Message_To_Patient SET Status=1 WHERE (Patient_name = '$_SESSION[Name]' AND Patient_home_phone = '$_SESSION[Home_phone]')";
	  $result2 = mysqli_query($con,$query2);
	}
	if($_SESSION[User_type] == "Doctor")
	{
		$query = "SELECT Patient_name, Date_time, Content, Status FROM Sends_Message_To_Doctor WHERE Doctor_license_number = '$_SESSION[License_number]' ORDER BY Date_time DESC";
	  	$result = mysqli_query($con,$query);
    	$query2 = "SELECT Doctor_license_one, Date_time, Content, Status FROM Communicates_With WHERE Doctor_license_two = '$_SESSION[License_number]' ORDER BY Date_time DESC";
  	  	$result2 = mysqli_query($con,$query2);
		echo "<h2><div id='title'>Messages from Patients<div></h2>
			<br><br>";
		echo "<table border='1'>
		<tr>
		<th>Status</th>
		<th>Date</th>
		<th>From</th>
		<th>Message</th>
		</tr>";
		while($row = mysqli_fetch_array($result))
		  {
			  $read = "Unread";
			  if ($row['Status'] == 1)
			  {
			  	$read = "Read";
			  }
		  echo "<tr>";
		  echo "<td>$read<br></td>";
		  echo "<td> " . $row['Date_time'] . "<br></td>";
		  echo "<td> " . $row['Patient_name'] . "<br></td>";
		  echo "<td> " . $row['Content'] . "<br></td>";
		  echo "</tr>";
		  }
		echo "</table>";
		echo "<h2><div id='title'>Messages from Doctors<div></h2>
			<br><br>";
		echo "<table border='1'>
		<tr>
		<th>Status</th>
		<th>Date</th>
		<th>From</th>
		<th>Message</th>
		</tr>";
		while($row = mysqli_fetch_array($result2))
		  {
			  $docQuery = "SELECT First_name, Last_name FROM Doctor WHERE License_number = $row[Doctor_license_one]";
	  	 	  $docName = mysqli_query($con,$docQuery);
			  $docName = mysqli_fetch_array($docName);
			  $read = "Unread";
			  if ($row['Status'] == 1)
			  {
			  	$read = "Read";
			  }
		  echo "<tr>";
		  echo "<td>$read<br></td>";
		  echo "<td> " . $row['Date_time'] . "<br></td>";
		  echo "<td> Dr. " . $docName['First_name'] . " "  . $docName['Last_name'] . "<br></td>";
		  echo "<td> " . $row['Content'] . "<br></td>";
		  echo "</tr>";
		  }
		echo "</table><a href='https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/' target='_self'>back</a>";
	    $query3 = "UPDATE Sends_Message_To_Doctor SET Status=1 WHERE Doctor_license_number = '$_SESSION[License_number]'";
	 	$result3 = mysqli_query($con,$query3);
	  	$query4 = "UPDATE Communicates_With SET Status=1 WHERE Doctor_license_two = '$_SESSION[License_number]'";
  	  	$result4 = mysqli_query($con,$query4);
	}
}
?>