<?php
session_start();
//script to add allergy(javascript)
echo '<script>
count = 0;
var allergies = "";
function myFunction()
{
	if (document.getElementById("allergy").value == "")
	{
		document.getElementById("allergyerror").innerHTML = "Please enter an allergy";
	}
	else if (!(document.getElementById("allergy").value.indexOf(",") === -1))
	{
		document.getElementById("allergyerror").innerHTML = "No commas please :)";
	}
	else if (document.getElementById("name").value == "")
	{
		document.getElementById("nameerror").innerHTML = "Please enter a name before you add the allergy";
	}
	else if (document.getElementById("homephone").value == "")
	{
		document.getElementById("homephoneerror").innerHTML = "Please enter a home phone number before you add the allergy";
	}
	else if (allergies == "")
	{
		allergies = allergies.concat(document.getElementById("allergy").value);
		document.getElementById("allergysubmit").value = allergies;
		document.getElementById("allergy").value = "";
	}
	else
	{
		allergies = allergies.concat(",");
		allergies = allergies.concat(document.getElementById("allergy").value);
		
		document.getElementById("allergy").value = "";
		count++;
		document.getElementById("allergysubmit").value = allergies;
	}
}
</script>';


//if a user is a patient show the HTML for the patient
if($_SESSION[User_type] == "Patient")
{
	echo "<h2>Create Patient Profile</h2>
<form method='post' action='CreateProfileHelper.php'> 
   Patient Name: <input type='text' name='name' id='name'> <p  id='nameerror'></p>
   <br><br>
   Date of Birth: <input type='text' name='dateofbirth'>
   <br><br>
   Gender: <input type='radio' name='gender' 	value='female'>Female
   <input type='radio' name='gender' value='male'>Male
   <br><br>
   Address: <input type='text' name='address'>
   <br><br>
   Home Phone: <input type='text' name='homephone' id='homephone'><p  id='homephoneerror'></p>
   <br><br>
   Work Phone: <input type='text' name='workphone'>
   <br><br>
   Weight: <input type='text' name='weight'>
   <br><br>
   Height: <input type='text' name='height'>
   <br><br>
   Annual Income: <input type='text' name='annualincome'>
   <br><br>
   Allergies: <input type='text' name='allergies' id='allergy'>
   <button type='button' onclick='myFunction()'>Add Allergy</button>
   <p  id='allergyerror'></p> <input type='text' name='allergysubmit' id='allergysubmit' readonly>
   <br><br>
   <input type='submit' name='submit' value='Submit'> 
</form>";
}

if($_SESSION[User_type] == "Doctor")
{
	header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/CreateDoctorProfile");
}

?>