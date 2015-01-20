<?php
session_start();


// define variables and set to empty values
$name = $dateofbirth = $gender = $address = $homephone = $workphone = $weight = $height = $annualincome = $allergies = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $name = test_input($_POST["name"]);
   $dateofbirth = test_input($_POST["dateofbirth"]);
   $gender = test_input($_POST["gender"]);
   $address = test_input($_POST["address"]);
   $homephone = test_input($_POST["homephone"]);
   $workphone = test_input($_POST["workphone"]);
   $weight = test_input($_POST["weight"]);
   $height = test_input($_POST["height"]);
   $annualincome = test_input($_POST["annualincome"]);
   $allergies = test_input($_POST["allergies"]);
   
   $con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
   // Check connection
   if (mysqli_connect_errno())
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
  
   if (isset($_REQUEST['Username'])) {
   $sql="INSERT INTO Patient(Name, Home_phone, Username, Date_of_birth, Gender, Address, Annual_income, Work_phone, Weight, Height)
       VALUES 
           ('$name', '$homephone', '$_SESSION[username]', '$dateofbirth', '$gender', '$address', '$annualincome', '$workphone', '$weight', '$height')";


   if (!mysqli_query($con,$sql))
     {
     die('Error: ' . mysqli_error($con));
     }
   echo "Entry was added!";
   } //end isset
   mysqli_close($con);
}



function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'> 
   Patient Name: <input type="text" name="name">
   <br><br>
   Date of Birth: <input type="text" name="dateofbirth">
   <br><br>
   Gender: <input type="radio" name="gender" 	value="female">Female
   <input type="radio" name="gender" value="male">Male
   <br><br>
  
   Address: <input type="text" name="address">
   <br><br>
   Home Phone: <input type="text" name="homephone">
   <br><br>
   Work Phone: <input type="text" name="workphone">
   <br><br>
   Weight: <input type="text" name="weight">
   <br><br>
   Height: <input type="text" name="height">
   <br><br>
   Annual Income: <input type="text" name="annualincome">
   <br><br>
   Allergies: <input type="text" name="allergies">
   <br><br>
   
  
   <input type="submit" name="submit" value="Submit"> 
</form>