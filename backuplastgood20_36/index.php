<?php
// define variables and set to empty values
$passwordErr = "";
$username = $password = "";
//starts the session
session_start();
//if they are logged in redirect to homepage
if($_SESSION[username] != '')
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
}
//if the request to the page is a post
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//grab the username the user entered
	$test1 = $_POST["username"];
	//grab the password the user entered
	$test2 = $_POST["password"];
	//connection string to the DB
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	//if there is an error connecting to the db show it
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//query to match up the username and password from the db
	$query = "SELECT * 
				FROM `User` 
				WHERE `Username` = '$test1' 
				AND `Password` = '$test2'
				";
	//gets the result of the query
	$result = mysqli_query($con, $query);
	//closes connection to the DB
	mysqli_close($con);
	//gets the data of the result	
	$row = mysqli_fetch_array($result);
	//checks to see if the username or password is empty(not a valid login)
	if (empty($_POST["password"]) || empty($_POST["username"]))
    {
		$passwordErr = "Incorrect Username/Password";
	}
   	else
	{
		$password = test_input($_POST["password"]);
	}
	//saves password and username in session and goes to login helper function
	if ($row['Password'] != "")
    {
		//starts user session
		session_start();
		//saves username in session
		$_SESSION[username]=$row['Username'];
		//saves password in session
		$_SESSION[password]=$row['Password'];
		//redirects user to login helper function page
 	   	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Login");
	}
	//else show an error
   	else
    {
		$passwordErr = "Incorrect Username/Password";
	}
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
   <input type="submit" name="submit" value="Login">
   <br><br>
   <a href="https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/CreateUser" target="_self">Create New User</a> 
   
</form>

</body>
</html>