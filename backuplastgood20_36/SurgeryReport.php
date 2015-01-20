<!-- SELECT Surgery_type, CPT_code, COUNT(Performs.Doctor_license_number) as 'numofprocedures', COUNT(DISTINCT Performs.Doctor_license_number) as 'numdoctorsperforming', (Surgery.Cost_of_surgery*COUNT(Performs.Doctor_license_number)) as 'total' FROM Surgery LEFT JOIN Performs ON Surgery.CPT_code=Performs.Surgery_CPT_code GROUP BY CPT_code -->

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
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query = "SELECT Surgery_type, CPT_code, COUNT(Performs.Doctor_license_number) as 'numofprocedures', COUNT(DISTINCT Performs.Doctor_license_number) as 'numdoctorsperforming', (Surgery.Cost_of_surgery*COUNT(Performs.Doctor_license_number)) as 'total' FROM Surgery LEFT JOIN Performs ON Surgery.CPT_code=Performs.Surgery_CPT_code GROUP BY CPT_code";
$result = mysqli_query($con,$query);
echo "<h2><div id='title'>Surgeries Performed</div></h2>";
echo "<table border='1'>
<tr>
<th>Surgery Type</th>
<th>CPT Code</th>
<th>Number of Procedures</th>
<th>Number of Doctors performing the Procedure</th>
<th>Total Billing($)</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Surgery_type'] . "</td>";
  echo "<td>" . $row['CPT_code'] . "</td>";
  echo "<td>" . $row['numofprocedures'] . "</td>";
  echo "<td>" . $row['numdoctorsperforming'] . "</td>";
  echo "<td>" . $row['total'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>