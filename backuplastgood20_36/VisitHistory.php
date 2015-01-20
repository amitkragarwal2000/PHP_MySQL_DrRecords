<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Visit History</title>
	<style>
    	body {
        	font-family: Arial;
    	}
    	#title {
        	background-color: gray;
        	border-radius: 5%;
        	padding: 20px;
        	width: 50%;
    	}
    	.error {
        	color: red;
    	}
	</style>
	</head>
    <body>
		
<?php

//starts the users session
session_start();
//if user is not logged in redirect them to index page
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
if($_SESSION[User_type] == 'Patient')
{
	//connection string to connect to DB
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//Check to see if any problem connecting to DB
	if (mysqli_connect_errno())
	{
		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	echo "<h2><div id='title'>View Visit History<div></h2>
		<br><br>";
	echo "<form name='dateForm' action='' method='post'>";
	echo "<select name='date' size='5'>";
	
    $query = "SELECT DISTINCT Date_of_visit FROM Visit WHERE (Patient_name = '$_SESSION[Name]') ";
    $result = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($result))
	  {
		  $dateOfVisit = $row['Date_of_visit'];
  		echo "<option name='date' value='$dateOfVisit'>$dateOfVisit</option>";
	  } 
  }
if($_SESSION[User_type] == 'Doctor')
{
//connection string to connect to DB
$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
//Check to see if any problem connecting to DB
if (mysqli_connect_errno())
{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "<h2><div id='title'>View Visit History<div></h2>
	<br><br>";
echo "<form name='dateForm' action='' method='post'>";
echo "<select name='date' size='5'>";
  $patientName = $_POST['patientName'];
  $query = "SELECT DISTINCT Date_of_visit FROM Visit WHERE (Patient_name = '$patientName') ";
  $result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
  {
	  $dateOfVisit = $row['Date_of_visit'];
		echo "<option name='date' value='$dateOfVisit'>$dateOfVisit</option>";
  } 
}
	  ?>
  </select>
  <br>
  <input type='submit' name='dateSubmit' value='Submit'/>
 </form>
	  <br><br>
	  Consulting Doctor:
	  <?php
	  $date = $_POST['date'];
	  
      $query = "SELECT * FROM Visit, Doctor 
		  WHERE (Visit.Patient_name = '$_SESSION[Name]' AND Visit.Patient_home_phone = '$_SESSION[Home_phone]' AND Visit.Date_of_visit = '$date' AND Visit.license_number = Doctor.License_number)";
      $result = mysqli_query($con,$query);
  	  $row = mysqli_fetch_array($result);
  	  $DFName = $row['First_name'];
	  $DLName = $row['Last_name'];
    		echo "Dr. $DFName $DLName";
  	  
	  ?>
	  <br><br>
	  Blood Pressure:
	  Systolic:
	  <?php
      $query = "SELECT * FROM Visit 
		  WHERE (Patient_name = '$_SESSION[Name]' AND Patient_home_phone = '$_SESSION[Home_phone]' AND Date_of_visit = '$date')";
      $result = mysqli_query($con,$query);
  	  $row = mysqli_fetch_array($result);
  	  $sys = $row['Systolic'];
    		echo "$sys";
  	  
	  ?>
	  Diastolic: 
	  <?php
      $query = "SELECT * FROM Visit 
		  WHERE (Patient_name = '$_SESSION[Name]' AND Patient_home_phone = '$_SESSION[Home_phone]' AND Date_of_visit = '$date')";
      $result = mysqli_query($con,$query);
  	  $row = mysqli_fetch_array($result);
  	  $dias = $row['Diastolic'];
    		echo "$dias";
  	  
	  ?>
	   <br><br>
	  Diagnosis:
	  <?php
      $query = "SELECT * FROM Diagnosis 
		  WHERE (Patient_name = '$_SESSION[Name]' AND Patient_home_phone = '$_SESSION[Home_phone]' AND Date_of_visit = '$date')";
      $result = mysqli_query($con,$query);
  	  $row = mysqli_fetch_array($result);
  	  $diagnosis = $row['Diagnosis'];
    		echo "$diagnosis";
	  ?>
	   <br><br>
	  Medications Prescribed:
	  <table border=1px>
		  <tr>
			<td>Medicine Name</td>  
			<td>Dosage</td> 
			<td>Duration</td> 
			<td>Notes</td> 
		</tr>
		
	<?php
    $query = "SELECT * FROM Prescription WHERE (Patient_name = '$_SESSION[Name]' AND Patient_home_phone = '$_SESSION[Home_phone]' AND Date_of_visit = '$date')";
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($result))
	  {
		 echo  '<tr>';
	  $medName = $row['Medicine_name'];
  		echo "<td name='Medicine' value='$medName'>$medName</td>";
	  $dosage = $row['Dosage'];
		echo "<td name='Dosage' value='$dosage'>$dosage</td>";
	  $duration = $row['Duration'];
		echo "<td name='Duration' value='$duration'>$duration</td>";
	  $notes = $row['Notes'];
		echo "<td name='Notes' value='$notes'>$notes</td>";
		 echo  '<tr>';
	  } 
	?>
	</tr>
	</table>
	  
</html>