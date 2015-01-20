<?php
//starts user session to use session variables
session_start();
//checks to see if the request for the page is a POST
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Connection string to database
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
   	// Check connection
   	if (mysqli_connect_errno())
    {
    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	if ($_SESSION[User_type] == "Patient")
	{
		$sql = "INSERT INTO Patient
						(Name, 
						 Home_phone, 
						 Username, 
						 Date_of_birth, 
						 Gender, 
						 Address, 
						 Annual_income, 
						 Work_phone, 
						 Weight, 
						 Height) 
					VALUES 
						('$_POST[name]', 
						 '$_POST[homephone]', 
						 '$_SESSION[username]', 
						 '$_POST[dateofbirth]', 
						 '$_POST[gender]', 
						 '$_POST[address]', 
						 '$_POST[annualincome]', 
						 '$_POST[workphone]', 
						 '$_POST[weight]', 
						 '$_POST[height]')
						 ";
		//checks to see if the query went through and executes it
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
       	}
		//checks to see if there were any allergies submitted to POST
		if ($_POST[allergysubmit] !="")
		{
			//splits the allergy list into seperate values
			$allergyList = explode(",", $_POST[allergysubmit]);
			//foreach loop that adds all of the allergies
			foreach ($allergyList as $val)
			{
				//SQL query to add allergies into the allergies table
				$sql1 = "INSERT INTO Allergies
								(Allergy, 
								 Patient_name, 
								 Patient_home_phone) 
							VALUES 
								('$val', 
								 '$_POST[name]', 
								 '$_POST[homephone]')
								 ";
				//checks to see if sql query went through and executes
			    if (!mysqli_query($con,$sql1))
			    {
			    	die('Error: ' . mysqli_error($con));
			    }
			}
		}
	}
	//closes SQL connection
	mysqli_close($con);
	//sends user to homepage
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Homepage");
}


?>