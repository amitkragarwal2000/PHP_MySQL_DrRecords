<?php
//starts the session
session_start();
//checks to see if user is logged in
if($_SESSION[username] == "")
{
	//if not sends user to index page
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
//if user is not an Admin
if($_SESSION[User_type] != 'Administrative_Personnel')
{
	//sends user to homepage, they shouldnt be here
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
}
//connection string for SQL login
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
{
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//selects the average rating of each specialty of a doctor
$query = "SELECT DISTINCT 
				License_number, 
				Specialty, 
				AVG(Rates.Rating) as 'Average Rating' 
			FROM Doctor 
			LEFT JOIN Rates 
			ON Doctor.License_number = Rates.Doctor_license_number 
			GROUP BY Specialty 
			ORDER BY Doctor.License_number
			";
// select the number of surgeries performed by specialty			
$query2 = "SELECT 
				Specialty, 
				COUNT(Performs.Doctor_license_number) as 'Number of Surgeries Performed' 
			FROM Doctor 
			LEFT JOIN Performs 
			ON License_number = Performs.Doctor_license_number 
			GROUP BY Specialty 
			ORDER BY Doctor.License_number
			";
//execute the first sql query
$result = mysqli_query($con,$query);
//execute the second sql query
$result2 = mysqli_query($con,$query2);
echo "<h2><div id='title'>Doctor Performance Report</div></h2>";
//create the table for the report
echo "<table border='1'><tr>
		<th>Specialty</th>
		<th>Average Rating</th>
		<th>Number of Surgeries Performed</th>
	 </tr>";
//fetch all of the rows for the results
while($row = mysqli_fetch_array($result))
{
	  //gets the rows the the second query
	  $row2 = mysqli_fetch_array($result2);
	  echo "<tr>";
	  //fills in the specialty column
	  echo "<td>" . $row['Specialty'] . "</td>";
	  //checks to see if the rating is null if it is put 0
	  if($row['Average Rating'] == null)
	  {
  		  echo "<td>" . 0 . "</td>";
	  }
	  else
	  {
		  //if not 0 put the actually rating
		  echo "<td>" . $row['Average Rating'] . "</td>";
	  }
	  //puts the number of surgeries performed column
	  echo "<td>" . $row2['Number of Surgeries Performed'] . "</td>";
	  echo "</tr>";
}
//ends the table
echo "</table>";
//closes the sql connection 
mysqli_close($con);
?>