<?php
// define variables and set to empty values
$passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$test1 = $_POST["username"];
$test2 = $_POST["password"];
$query = "SELECT * FROM `User` WHERE `Username` = '$test1' AND `Password` = '$test2'";
$result = mysqli_query($con, $query);
mysqli_close($con);

$row = mysqli_fetch_array($result);

   if (empty($_POST["password"]) || empty($_POST["username"]))
     {$passwordErr = "Incorrect Username/Password";}
   else
     {$password = test_input($_POST["password"]);}
   if ($row['Password'] != "")
     {
		 session_start();
	 $_SESSION['username']=$row['Username'];
	 $_SESSION['password']=$row['Password'];
 	 header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/chad/sessionTest2");}
   else
     {$passwordErr = "Incorrect Username/Password";}
     
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>

<h2><div id="title">Login Page<div></h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Username: <input type="text" name="username">
   <br><br>
   Password: <input type="password" name="password">
   <span class="error"> <?php echo $passwordErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>