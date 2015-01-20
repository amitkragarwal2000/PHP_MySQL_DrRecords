<?php
$newtest = "";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	echo $_POST['happy'];
}
// if($_SESSION[username] == "")
// {
// 	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/");
// }
// if($_SESSION[User_type] != 'Administrative_Personnel')
// {
// 	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad_dev/Homepage");
// }
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query = "SELECT DISTINCT Name, Home_phone FROM Patient";
$result = mysqli_query($con,$query);
echo "<h2><div id='title'>Surgery Record</div></h2>";
 $newtest = htmlspecialchars($_SERVER["PHP_SELF"]);
echo "<form method='post' action=" . $newtest . ">"; 
echo "<table border='1'>
<tr>
<th>Name</th>
<th>Phone number</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  $happy = $row['Name'];
  echo "<td> <input type='radio' name='happy' value='$happy'>" . $row['Name'] . "<br></td>";
  echo "<td>" . $row['Home_phone'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
echo "<input type='submit' name='submit' value='Submit'>";
mysqli_close($con);
?>
