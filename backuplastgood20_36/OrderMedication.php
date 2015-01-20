<!DOCTYPE HTML> 
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
			<h2 id="title">Order Medication</h2>
					<!-- <?php
						session_start();
						if($_SESSION[User_type] == "Patient")
						{
							if ($_SERVER["REQUEST_METHOD"] == "POST")
							{
							
								$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");

								if (mysqli_connect_errno())
								{
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								$query = "INSERT INTO Prescription(Medicine_name, Patient_name, Patient_home_phone, Date_of_visit, License_number, Duration, Dosage) VALUES ('$_POST[Medicine_name]', '$_POST[Patient_name]', '$_POST[Patient_home_phone]', '$_POST[Date_of_visit]', '$_POST[License_number]', '$_POST[Duration]', '$_POST[Dosage]')";
								if (!mysqli_query($con,$query))
								{
									die('Error: ' . mysqli_error($con));
								}
			// How do I get the patient home phone and name and doc license number?
								echo "Entry was added!";
								mysqli_close($con);

								$row = mysqli_fetch_array($result);
							}
		
						}
	
					?> -->
					
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		   Medicine Name: <input type="text" name="Medicine_name">
		 
	
		   <br><br>
		   Dosage: <select name="dosage">
		   		<option value="1">1</option>
		        <option value="2">2</option>
			    <option value="3">3</option>
				<option value="3">4</option>
				<option value="3">5</option>
		   </select>
		   <br><br>
		   Duration: <select name="duration">
			    <?php for ($i = 1; $i <= 100; $i++) : ?>
			           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			       <?php endfor; ?>
		   </select>
		     <br><br>
		   Consulting Doctor: <?php
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$query = "SELECT * FROM `Doctor`";
	$result = mysqli_query($con, $query);
	echo "<form><br><br>Select Doctor: <select name='doctorName'>";
		
	while ($row = mysqli_fetch_array($result))
	{
		echo "<option value=''>" . $row['First_name'] . " " . $row['Last_name'] . "</option>";
	}
	echo "<br></select><br><br>";
?>
		   <br><br>
		   Date of Perscription: <select name="date">
			   	<?php for ($i = 1; $i <= 12; $i++) : ?>
			    	 <?php for ($j = 1; $j <= 31; $j++) : ?>
			          	 <option value="<?php echo $i."/".$j."/2014"; ?>"><?php echo $i."/".$j."/2014"; 							?></option>
			      	 <?php endfor; ?>
				<?php endfor; ?>
		   </select>
		</form>
		<br><br>
		<input type='submit' name='submit' value='Submit'></form>
	</body> 
</html>