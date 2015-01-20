<?php
session_start();
if($_SESSION[username] == "")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
}
if($_SESSION[User_type] == "Patient")
{
	$con = mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
	$querycheck = "SELECT * 
					FROM Payment_Information 
					WHERE Username = '$_SESSION[username]'";
	$resultCheck = mysqli_query($con,$querycheck);
	$rowCheck = mysqli_fetch_array($resultCheck);
	if ($rowCheck['Username'] != "") 
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$test1 = $_POST["cardholder"];
		$test2 = $_POST["password"];
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$query = "INSERT INTO Payment_Information(Card_number, 
							  CVV, 
							  Expiration_date, 
							  Cardholders_name, 
							  Type, 
							  Username) 
					VALUES ('$_POST[cardnumber]', 
							'$_POST[cvv]',
							'$_POST[expirationdate]',
							'$_POST[cardholders_name]',
							'$_POST[cardtype]',
							'$_SESSION[username]')";
		if (!mysqli_query($con,$query))
		{
			die('Error: ' . mysqli_error($con));
		}

		echo "Entry was added!";
		mysqli_close($con);

		$row = mysqli_fetch_array($result);
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
	}
	
	
	
	
	
	
	
}

?>


<h2><div id="title">Payment Information<div></h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   CardHolder's name: <input type="text" name="cardholders_name">
   <br><br>
   Card Number: <input type="text" name="cardnumber">
   <span class="error"> <?php echo $passwordErr;?></span>
   <br><br>
   Type of Card: <select name="cardtype">
       <option value="Visa">Visa</option>
       <option value="Mastercard">Mastercard</option>
	<option value="American Express">American Express</option>
   </select>
   CVV: <input type="text" name="cvv">
   <br><br>
   Expiration Date:(format 2014-04-01) <input type="text" name="expirationdate">
   <br><br>
   <input type="submit" name="submit" value="Submit">
   
</form>

</body>
</html>