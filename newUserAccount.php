<!DOCTYPE HTML> 
<html>
<head>
    <style>
        body {
            font-family: Arial;
        }
        #title {
            background-color: gray;
            border-radius: 5%;
            padding: 20px;
            width: 50%;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body> 

<?php
// define variables and set to empty values
$Username = $Password = $ConfirmPassword = "";
$UsernameErr = $PasswordErr = $ConfirmPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["Username"])) {
        $UsernameErr = "Username is a required field";
    } else {
        $Username = test_input($_POST["Username"]);
    }
    if (empty($_POST["Password"])) {
        $PasswordErr = "Password is a required field";
    } else {
        $Password = test_input($_POST["Password"]);
    }
    if (empty($_POST["ConfirmPassword"])) {
        $PasswordErr = "Password Mismatch!";
    } else {
        $ConfirmPassword = test_input($_POST["ConfirmPassword"]);
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

<h2><div id="title">Create New User Account</div></h2>
<form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'> 
    Username: <input type="text" name="Username">
    <span class="error">* <?php echo $UsernameErr;?></span>
    <br><br>
    Password: <input type="text" name="Password">
    <span class="error">* <?php echo $PasswordErr;?></span>
    <br><br>
    Confirm Password: <input type="text" name="ConfirmPassword
    <span class="error">* <?php echo $ConfirmPasswordErr;?></span>
    <br><br>
    Type: <select>
        <option value="Doctor">Doctor</option>
        <option value="Patient">Patient</option>
    </select>
    <br><br>
   
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if (isset($_REQUEST['Username']) && isset($_REQUEST['Password']) && $_REQUEST['Password'] == $_REQUEST['ConfirmPassword']) {
$sql="INSERT INTO User(Username, Password)
    VALUES 
        ('$_POST[Username]','$_POST[Password]')";
        
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Entry was added!";
} //end isset
mysqli_close($con);
?>

</body>
</html>