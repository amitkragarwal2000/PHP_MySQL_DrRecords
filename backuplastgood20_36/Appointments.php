<?php
session_start();
// if($_SESSION[username] == "")
// {
// 	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
// }
if($_SESSION[User_type] == "Patient")
{
	
	echo "<h2><div id='title'>Schedule appointments with doctor<div></h2>";
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	$query = "SELECT DISTINCT Specialty FROM Doctor";
	$result = mysqli_query($con,$query);
 $newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
echo "<form method='post' action=" . $newtest . ">";
	echo "<br><br><select id = 'specialty' name='specialty' >";
	 
	while($row = mysqli_fetch_array($result))
	{
		$spec = $row['Specialty'];
		echo "<option value='$spec' >$spec</option>";
	}
	echo "</select>";
	 
	echo "<input type='submit' name='submit' value='Search'></form>";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		echo "<table border='1'>
		<tr>
		<th>Doctor Name</th>
		<th>Phone Number</th>
		<th>Room Number</th>
		<th>Availability</th>
		<th>Average Rating</th>
		</tr>";
		$query2 = "SELECT DISTINCT * FROM Doctor WHERE Specialty='$_POST[specialty]'";
		$result2 = mysqli_query($con,$query2);
		while ($row2 = mysqli_fetch_array($result2))
		{
			echo "<tr>";
			$count = $row2['License_number'];
			echo "<td>Dr. " . $row2['First_name'] . $row2['Last_name'] ."</td>";
			echo "<td>" . $row2['Work_phone'] ."</td>";
			echo "<td>" . $row2['Room_number'] ."</td>";
			
			$queryRate = "SELECT AVG(RATING) as 'rating' FROM Rates WHERE Doctor_license_number='$count'";
			$resultRate = mysqli_query($con,$queryRate);
			$rowRate = mysqli_fetch_array($resultRate);
			echo "<td>  </td>";
			if ($rowRate['rating'] == '') 
			{
				echo "<td> None </td>";
			}
			else 
			{
				echo "<td>" . $rowRate['rating'] ."</td>";
			}
			
			echo "</tr>";
		}
		echo "</table>";
	}
}


?>