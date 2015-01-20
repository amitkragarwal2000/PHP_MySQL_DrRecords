<?php
session_start();
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
if($_SESSION[User_type] != 'Administrative_Personnel')
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
}
$newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
echo "<form method='post' action=" . $newtest . ">";
echo "<h2><div id='title'>Patient Visit Report</div></h2>";
echo "Select Month: <select name='month' id='month'>
    <option value='' selected='selected'>(Select Month)</option> 
    <option value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
</select>
<select name='year' id='year'>
    <option value='' selected='selected'>(Select a Year)</option> 
    <option value='1980'>1980</option>
    <option value='1981'>1981</option>
    <option value='1982'>1982</option>
    <option value='1983'>1983</option>
    <option value='1984'>1984</option>
    <option value='1985'>1985</option>
    <option value='1986'>1986</option>
    <option value='1987'>1987</option>
    <option value='1988'>1988</option>
    <option value='1989'>1989</option>
    <option value='1990'>1990</option>
    <option value='1991'>1991</option>
    <option value='1992'>1992</option>
    <option value='1993'>1993</option>
    <option value='1994'>1994</option>
    <option value='1995'>1995</option>
    <option value='1996'>1996</option>
    <option value='1997'>1997</option>
    <option value='1998'>1998</option>
    <option value='1999'>1999</option>
    <option value='2000'>2000</option>
    <option value='2001'>2001</option>
    <option value='2002'>2002</option>
    <option value='2003'>2003</option>
    <option value='2004'>2004</option>
    <option value='2005'>2005</option>
    <option value='2006'>2006</option>
    <option value='2007'>2007</option>
    <option value='2008'>2008</option>
    <option value='2009'>2009</option>
    <option value='2010'>2010</option>
	<option value='2011'>2011</option>
	<option value='2012'>2012</option>
	<option value='2013'>2013</option>
	<option value='2014'>2014</option>
</select>
<input type='submit' name='submit' value='Submit'></form>

";
echo "<table border='1'>
<tr>
<th>Doctor Name</th>
<th>Number of Patients seen</th>
<th>Number of Prescriptions written</th>
<th>Total Billing ($)</th>
</tr>";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $date = $_POST[year] . "-" . $_POST[month] . "-01";
  $dateend = $_POST[year] . "-" . $_POST[month] . "-31";

  $query2 = "SELECT DISTINCT First_name, Last_name, Doctor.License_number as 'License_number', Specialty, COUNT(Patient_name) as 'silly', SUM(Billing_amount) as 'cheese' From Doctor Left JOIN Visit on Doctor.License_number= Visit.License_number WHERE Date_of_visit BETWEEN '$date' AND '$dateend' group by Doctor.License_number  Order by Doctor.License_number ";
$result2 = mysqli_query($con,$query2);
	while($row2 = mysqli_fetch_array($result2))
	  {
		  
	  echo "<tr>";
	  echo "<td>Dr. " . $row2['First_name'] . " " . $row2['Last_name'] . "</td>";
	  echo "<td>" . $row2['silly'] . "</td>";
	  $query = "SELECT COUNT(Patient_name) as 'prescript' From Prescription  WHERE  License_number='$row2[License_number]' AND Date_of_visit BETWEEN '$date' AND '$dateend'";
	  $result = mysqli_query($con,$query);
	  $result= mysqli_fetch_array($result);
	  if($result['prescript'] != "") { echo "<td>" . $result['prescript'] . "</td>"; }
	  else{ echo "<td>0</td>";}
	  echo "<td>" . $row2['cheese'] . "</td>";
	  
	  echo "</tr>";
	  $count++;
	  }
	echo "</table>";
	mysqli_close($con);
}
echo "</table>";


?>