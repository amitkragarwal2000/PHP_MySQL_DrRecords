<!DOCTYPE HTML>
<html> 
<body>
<?php
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"INSERT INTO User(Username, Password) VALUES (" + $_GET("username") + "," + $_GET('password')+ ")");
mysqli_close($con);
?>

<form action="welcome_get.php" method="get">
Username: <input type="text" name=“Username"><br>
Password: <input type="text" name=“Password”><br>
<input type="submit">
</form>

</body>
</html>