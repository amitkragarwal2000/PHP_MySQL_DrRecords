<?php
	$newtest = "";
	session_start();

 $newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
echo "<h2><div id='title'>Surgery Record</div></h2>";
echo "<form method='post' action=" . $newtest . ">
	Search Patient: <input type='text' name='search'>
<input type='submit' name='submit' value='Search'></form>"; 
echo "<script>function getPatient(c){document.getElementById('patientname').value = document.getElementById('happy'+ c).value;getPatientNum(c);}</script>";
echo "<script>function getPatientNum(c){document.getElementById('patientnum').value = document.getElementById('happ'+ c).value;}</script>";
echo "<script>function fillcpt(){document.getElementById('cptcode').value = document.getElementById('procedurename').value;
	var x = document.getElementById('procedurename').value;
	showButton(x);}</script>";
echo "<script>
function showButton(procedurename){
  document.getElementById(procedurename).style.display='block';
  document.getElementById('preop').value = document.getElementById(procedurename).value;
}
</script>";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query = "SELECT DISTINCT Name, Home_phone FROM Patient WHERE Name LIKE '%$_POST[search]%'";
$result = mysqli_query($con,$query);
  
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
	  $happy = $row['Name'];
	  echo "<td> <input type='radio' id='happy$count' name='happy' value='$happy' onclick='getPatient($count)'>" . $row['Name'] . "<br></td>";
	  echo "<td><input type='' id='happ$count' value=" . $row['Home_phone'] . " readonly></td>";
	  echo "</tr>";
	  $count++;
	  }
	echo "</table>";
	
}
echo "<form method='post' action='RecordTheSurgery.php'>
	Patient Name: <input type='text' id = 'patientname' name='patientname' readonly>
	<br><br>
	Patient Phone Number: <input type='text' id = 'patientnum' name='patientnum' readonly>
	<br><br>
	Surgeon Name: <input type='text' id = 'doctorname' name='doctorname' value='Dr. " . $_SESSION[First_name] ." " . $_SESSION[Last_name] . "'>
	<br><br><select id = 'procedurename' name='procedurename' >";
    $query4 = "SELECT DISTINCT Surgery_type, CPT_code FROM Surgery";
  $result4 = mysqli_query($con,$query4);
  while($row4 = mysqli_fetch_array($result4))
  {
	$proc = $row4['Surgery_type'];
	$cpt = $row4['CPT_code'];
	echo "<option value='$cpt' onclick='fillcpt()'>$proc</option>";
  }
	echo "</select><br><br>";

	$query10 = "SELECT DISTINCT Preoperative_medications, Surgery_CPT_code FROM Preoperative_Medications";
	$result10 = mysqli_query($con,$query10);
	$arrCount = 0;
	while($row10 = mysqli_fetch_array($result10)) 
	{
		if ($procArray[$row10['Surgery_CPT_code']] != '') 
		{
			$procArray[$row10['Surgery_CPT_code']] = $procArray[$row10['Surgery_CPT_code']]. ",".$row10['Preoperative_medications'];
		}
		else {
			$procArray[$row10['Surgery_CPT_code']] = $row10['Preoperative_medications'];
		}
	}
	foreach ($procArray as $val => $v)
	{
		// echo $val;
		 //echo $v;
		echo "<input type='hidden'id='$val' value = '$v'>";
	}
	echo "CPT Code: <input type='text' id = 'cptcode' name='cptcode'>
	<br><br>
	Number of Assistants: <select id = 'numassist' name='numassist'>
	  <option value='1'>1</option>
	  <option value='2'>2</option>
	  <option value='3'>3</option>
	  <option value='4'>4</option>
	</select>
	<br><br>
	Pre-operative Medications: <input type='text' id = 'preop' name='preop'>
	<br><br>
	Surgery Start Time: <select name='starttime' id='starttime'>
	    <option value='' selected='selected'>(Select a Time)</option> 
	    <option value='12:00 AM'>12:00 AM</option>
	    <option value='12:30 AM'>12:30 AM</option>
	    <option value='1:00 AM'>1:00 AM</option>
	    <option value='1:30 AM'>1:30 AM</option>
	    <option value='2:00 AM'>2:00 AM</option>
	    <option value='2:30 AM'>2:30 AM</option>
	    <option value='3:00 AM'>3:00 AM</option>
	    <option value='3:30 AM'>3:30 AM</option>
	    <option value='4:00 AM'>4:00 AM</option>
	    <option value='4:30 AM'>4:30 AM</option>
	    <option value='5:00 AM'>5:00 AM</option>
	    <option value='5:30 AM'>5:30 AM</option>
	    <option value='6:00 AM'>6:00 AM</option>
	    <option value='6:30 AM'>6:30 AM</option>
	    <option value='7:00 AM'>7:00 AM</option>
	    <option value='7:30 AM'>7:30 AM</option>
	    <option value='8:00 AM'>8:00 AM</option>
	    <option value='8:30 AM'>8:30 AM</option>
	    <option value='9:00 AM'>9:00 AM</option>
	    <option value='9:30 AM'>9:30 AM</option>
	    <option value='10:00 AM'>10:00 AM</option>
	    <option value='10:30 AM'>10:30 AM</option>
	    <option value='11:00 AM'>11:00 AM</option>
	    <option value='11:30 AM'>11:30 AM</option>
	    <option value='12:00 PM'>12:00 PM</option>
	    <option value='12:30 PM'>12:30 PM</option>
	    <option value='1:00 PM'>1:00 PM</option>
	    <option value='1:30 PM'>1:30 PM</option>
	    <option value='2:00 PM'>2:00 PM</option>
	    <option value='2:30 PM'>2:30 PM</option>
	    <option value='3:00 PM'>3:00 PM</option>
	    <option value='3:30 PM'>3:30 PM</option>
	    <option value='4:00 PM'>4:00 PM</option>
	    <option value='4:30 PM'>4:30 PM</option>
	    <option value='5:00 PM'>5:00 PM</option>
	    <option value='5:30 PM'>5:30 PM</option>
	    <option value='6:00 PM'>6:00 PM</option>
	    <option value='6:30 PM'>6:30 PM</option>
	    <option value='7:00 PM'>7:00 PM</option>
	    <option value='7:30 PM'>7:30 PM</option>
	    <option value='8:00 PM'>8:00 PM</option>
	    <option value='8:30 PM'>8:30 PM</option>
	    <option value='9:00 PM'>9:00 PM</option>
	    <option value='9:30 PM'>9:30 PM</option>
	    <option value='10:00 PM'>10:00 PM</option>
	    <option value='10:30 PM'>10:30 PM</option>
	    <option value='11:00 PM'>11:00 PM</option>
	    <option value='11:30 PM'>11:30 PM</option>
	</select>
	<br><br>
	Surgery Completion Time<select name='endtime' id='endtime'>
	    <option value='' selected='selected'>(Select a Time)</option> 
	    <option value='12:00 AM'>12:00 AM</option>
	    <option value='12:30 AM'>12:30 AM</option>
	    <option value='1:00 AM'>1:00 AM</option>
	    <option value='1:30 AM'>1:30 AM</option>
	    <option value='2:00 AM'>2:00 AM</option>
	    <option value='2:30 AM'>2:30 AM</option>
	    <option value='3:00 AM'>3:00 AM</option>
	    <option value='3:30 AM'>3:30 AM</option>
	    <option value='4:00 AM'>4:00 AM</option>
	    <option value='4:30 AM'>4:30 AM</option>
	    <option value='5:00 AM'>5:00 AM</option>
	    <option value='5:30 AM'>5:30 AM</option>
	    <option value='6:00 AM'>6:00 AM</option>
	    <option value='6:30 AM'>6:30 AM</option>
	    <option value='7:00 AM'>7:00 AM</option>
	    <option value='7:30 AM'>7:30 AM</option>
	    <option value='8:00 AM'>8:00 AM</option>
	    <option value='8:30 AM'>8:30 AM</option>
	    <option value='9:00 AM'>9:00 AM</option>
	    <option value='9:30 AM'>9:30 AM</option>
	    <option value='10:00 AM'>10:00 AM</option>
	    <option value='10:30 AM'>10:30 AM</option>
	    <option value='11:00 AM'>11:00 AM</option>
	    <option value='11:30 AM'>11:30 AM</option>
	    <option value='12:00 PM'>12:00 PM</option>
	    <option value='12:30 PM'>12:30 PM</option>
	    <option value='1:00 PM'>1:00 PM</option>
	    <option value='1:30 PM'>1:30 PM</option>
	    <option value='2:00 PM'>2:00 PM</option>
	    <option value='2:30 PM'>2:30 PM</option>
	    <option value='3:00 PM'>3:00 PM</option>
	    <option value='3:30 PM'>3:30 PM</option>
	    <option value='4:00 PM'>4:00 PM</option>
	    <option value='4:30 PM'>4:30 PM</option>
	    <option value='5:00 PM'>5:00 PM</option>
	    <option value='5:30 PM'>5:30 PM</option>
	    <option value='6:00 PM'>6:00 PM</option>
	    <option value='6:30 PM'>6:30 PM</option>
	    <option value='7:00 PM'>7:00 PM</option>
	    <option value='7:30 PM'>7:30 PM</option>
	    <option value='8:00 PM'>8:00 PM</option>
	    <option value='8:30 PM'>8:30 PM</option>
	    <option value='9:00 PM'>9:00 PM</option>
	    <option value='9:30 PM'>9:30 PM</option>
	    <option value='10:00 PM'>10:00 PM</option>
	    <option value='10:30 PM'>10:30 PM</option>
	    <option value='11:00 PM'>11:00 PM</option>
	    <option value='11:30 PM'>11:30 PM</option>
	</select>
	<br><br>
	Anesthesia Start Time<select name='starttimea' id='starttimea'>
	    <option value='' selected='selected'>(Select a Time)</option> 
	    <option value='12:00 AM'>12:00 AM</option>
	    <option value='12:30 AM'>12:30 AM</option>
	    <option value='1:00 AM'>1:00 AM</option>
	    <option value='1:30 AM'>1:30 AM</option>
	    <option value='2:00 AM'>2:00 AM</option>
	    <option value='2:30 AM'>2:30 AM</option>
	    <option value='3:00 AM'>3:00 AM</option>
	    <option value='3:30 AM'>3:30 AM</option>
	    <option value='4:00 AM'>4:00 AM</option>
	    <option value='4:30 AM'>4:30 AM</option>
	    <option value='5:00 AM'>5:00 AM</option>
	    <option value='5:30 AM'>5:30 AM</option>
	    <option value='6:00 AM'>6:00 AM</option>
	    <option value='6:30 AM'>6:30 AM</option>
	    <option value='7:00 AM'>7:00 AM</option>
	    <option value='7:30 AM'>7:30 AM</option>
	    <option value='8:00 AM'>8:00 AM</option>
	    <option value='8:30 AM'>8:30 AM</option>
	    <option value='9:00 AM'>9:00 AM</option>
	    <option value='9:30 AM'>9:30 AM</option>
	    <option value='10:00 AM'>10:00 AM</option>
	    <option value='10:30 AM'>10:30 AM</option>
	    <option value='11:00 AM'>11:00 AM</option>
	    <option value='11:30 AM'>11:30 AM</option>
	    <option value='12:00 PM'>12:00 PM</option>
	    <option value='12:30 PM'>12:30 PM</option>
	    <option value='1:00 PM'>1:00 PM</option>
	    <option value='1:30 PM'>1:30 PM</option>
	    <option value='2:00 PM'>2:00 PM</option>
	    <option value='2:30 PM'>2:30 PM</option>
	    <option value='3:00 PM'>3:00 PM</option>
	    <option value='3:30 PM'>3:30 PM</option>
	    <option value='4:00 PM'>4:00 PM</option>
	    <option value='4:30 PM'>4:30 PM</option>
	    <option value='5:00 PM'>5:00 PM</option>
	    <option value='5:30 PM'>5:30 PM</option>
	    <option value='6:00 PM'>6:00 PM</option>
	    <option value='6:30 PM'>6:30 PM</option>
	    <option value='7:00 PM'>7:00 PM</option>
	    <option value='7:30 PM'>7:30 PM</option>
	    <option value='8:00 PM'>8:00 PM</option>
	    <option value='8:30 PM'>8:30 PM</option>
	    <option value='9:00 PM'>9:00 PM</option>
	    <option value='9:30 PM'>9:30 PM</option>
	    <option value='10:00 PM'>10:00 PM</option>
	    <option value='10:30 PM'>10:30 PM</option>
	    <option value='11:00 PM'>11:00 PM</option>
	    <option value='11:30 PM'>11:30 PM</option>
	</select>
	<br><br>
	<br><br>
	<textarea name='complications' cols='25' rows='5'>Enter your message here...</textarea>
	<input type='submit' name='submit' value='Submit'></form>";
	
mysqli_close($con);
?>
