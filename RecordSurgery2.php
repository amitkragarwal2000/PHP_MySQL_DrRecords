<?php
$newtest = "";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	echo $_POST['happy'];
}
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
$count = 0;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  $happy = $row['Name'];
  echo "<td> <input type='radio' id='happy$count' name='happy' value='$happy' onclick='dosomething($count)'>" . $row['Name'] . "<br></td>";
  echo "<td>" . $row['Home_phone'] . "</td>";
  echo "</tr>";
  $count++;
  }
echo "</table>";
echo "<script>function dosomething(c){document.getElementById('demo').innerHTML = document.getElementById('happy'+ c).value;}</script>";
echo "<p id='demo'></p>";
mysqli_close($con);
?>
