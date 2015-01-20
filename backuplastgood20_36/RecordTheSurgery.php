<?php
	session_start();

 $newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query ="INSERT INTO Performs(Doctor_license_number, Surgery_CPT_code, Patient_name, Patient_home_phone, Number_assistants, Surgery_start_time, Surgery_end_time, Anesthesia_start_time, Complications) VALUES ('$_SESSION[License_number]', '$_POST[cptcode]', '$_POST[patientname]','$_POST[patientnum]', '$_POST[numassist]', '$_POST[starttime]', '$_POST[endtime]', '$_POST[starttimea]', '$_POST[complications]')";
  if (!mysqli_query($con,$query))
{
	die('Error: ' . mysqli_error($con));
}

  mysqli_close($con);
  header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
}
header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
?>
