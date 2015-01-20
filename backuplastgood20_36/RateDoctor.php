<html>
	<head>
		<meta name="author" content="Tyler Lucas">
		<meta name="description" content="Rate A Doctor">
		<meta charset="UTF-8">
		
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
			<h2><div id="title">Rate A Doctor</div></h2>
<?php
		session_start();
 		if($_SESSION[username] == "")
 		{
 			header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
 		}
		
		$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		if ( $_SERVER["REQUEST_METHOD"] == "POST")
			{
				
				$license = $_POST['license'];
				
				$rating = $_POST['rating'];
				echo "test $license $rating";
				$query = "INSERT INTO Rates
					(Patient_name, Patient_home_phone, Doctor_license_number, Rating) 
					VALUES  ('$_SESSION[Name]', '$_SESSION[Home_phone]', '$license', '$rating')";
				// $result = mysqli_query($con, $query);
			
				if (!mysqli_query($con,$query))
				{
					die('Errorr: ' . mysqli_error($con));
				}
				mysqli_close($con);
				header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
			}
	$query = "SELECT * FROM Doctor Left Join Visit on Visit.Patient_name='$_SESSION[Name]' AND Visit.Patient_home_phone='$_SESSION[Home_phone]' Group By Visit.License_number";
	$result = mysqli_query($con, $query);
	?>
	
	<form method='post' action=''> 
		<br><br>Select Doctor: <select name='license'>
		
		<?php
	while ($row = mysqli_fetch_array($result))
	{
		$dFName = $row['First_name'];
		$dLName = $row['Last_name'];
		$license = $row['License_number'];
		echo "<option name='license' value='$license'>Dr. $dFName $dLName</option>";
	}
	
	echo "<br></select><br><br>";
	
?>

			<input type="radio" name="rating"  value="1">1</input>
			<input type="radio" name="rating"  value="2">2</input>
			<input type="radio" name="rating"  value="3">3</input>
			<input type="radio" name="rating"  value="4">4</input>
			<input type="radio" name="rating"  value="5">5</input>
		<br>
		<input type='submit' name='rateSubmit' value='Submit'/>
		</form>		
		
	</body> 
</html>