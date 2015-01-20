<!-- SELECT Specialty, AVG(Rates.Rating) as "Average Rating", COUNT(Performs.Doctor_license_number) as "Number of Surgeries Performed" From Doctor LEFT JOIN Rates on Doctor.License_number= Rates.Doctor_license_number LEFT JOIN Performs on Doctor.License_number=Performs.Doctor_license_number GROUP BY Specialty -->


<?php
session_start();
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/");
}
if($_SESSION[User_type] != 'Administrative_Personnel')
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Homepage");
}
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query = "SELECT Specialty, AVG(Rates.Rating) as 'Average Rating', COUNT(Performs.Doctor_license_number) as 'Number of Surgeries Performed' From Doctor LEFT JOIN Rates on Doctor.License_number= Rates.Doctor_license_number LEFT JOIN Performs on Doctor.License_number=Performs.Doctor_license_number GROUP BY Specialty";
$result = mysqli_query($con,$query);
echo "<h2><div id='title'>Doctor Performance Report</div></h2>";
echo "<table border='1'>
<tr>
<th>Specialty</th>
<th>Average Rating</th>
<th>Number of Surgeries Performed</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Specialty'] . "</td>";
  if($row['Average Rating'] == null)
  {
  	echo "<td>" . 0 . "</td>";
  }
  else{echo "<td>" . $row['Average Rating'] . "</td>";}
  echo "<td>" . $row['Number of Surgeries Performed'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>