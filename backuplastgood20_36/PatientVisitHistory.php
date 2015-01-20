<script>
 function submitForm(action)
    	{
        document.getElementById('form1').action = action;
        document.getElementById('form1').submit();
		document.getElementById('iframe').contentWindow.location.reload();
        }
</script>
<?php
	$newtest = "";
	session_start();
	
 $newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
echo "<h2><div id='title'>Patient Visit History</div></h2>";
echo "<form method='post' action=" . $newtest . ">
	Name: <input type='text' name='searchname'>
	Phone: <input type='text' name='searchphone'>
<input type='submit' name='submit' value='Search'></form>"; 

echo "<script>function getPatient(c){document.getElementById('patientname').value = document.getElementById('happy'+ c).value;getPatientNum(c);}</script>";
echo "<script>function getPatientNum(c){document.getElementById('patientnum').value = document.getElementById('happ'+ c).value;}</script>";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if ($_POST[searchphone] =='')
  {
  	$query = "SELECT DISTINCT Patient_name, Patient_home_phone FROM Requests_Appointment WHERE Doctor_license_number =  '$_SESSION[License_number]' AND Patient_name LIKE '%$_POST[searchname]%'";
  }
  else if ($_POST[searchname] =='')
  {
  	$query = "SELECT DISTINCT Patient_name, Patient_home_phone FROM Requests_Appointment WHERE Doctor_license_number =  '$_SESSION[License_number]' AND Patient_home_phone LIKE '%$_POST[searchphone]%'";
  }
  else
  {
  	$query = "SELECT DISTINCT Patient_name, Patient_home_phone FROM Requests_Appointment WHERE  Doctor_license_number =  '$_SESSION[License_number]'";
  }

}

  	echo "<form id='form1' action='' target='iframe' name='patientForm' method='post'>";
	$result = mysqli_query($con,$query);
	echo $_POST['happy'];
	echo "<table border='1'>
	<tr>
	<th>Name</th>
	<th>Phone number</th>
	</tr>";
	$count = 0;
    
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  $patientName = $row['Patient_name'];
	  echo "<td> <input type='' id='Patient$count' name='patientName' value='$patientName' readonly><br></td>";
	  echo "<td><input type='' id='Phone$count' value=" . $row['Patient_home_phone'] . " readonly></td>";
	  echo "<td><input type='button' name='patientName' onclick='submitForm('')' value='View'></td>";
	  echo "<td><input type='button' name='recordVisit' onclick='submitForm('RecordVisit.php')' value='Record A Visit'></td>";
	  echo "</tr>";
	  
	  $count++;
	  }
	echo "</table>";
	echo "</form>";

?>
<iframe name="iframe" id='iframe' width="100%" height="100%" src="VisitHistory.php" frameborder="0"></iframe>