<?php
session_start();
	if($_SESSION[username] == '')
	{
		header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
	}
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):
    //refill the values
    if (isset($_POST['licenseNumber'])) { $licenseNumber = $_POST['licenseNumber']; }
    if (isset($_POST['firstName'])) { $firstName = $_POST['firstName']; }
    if (isset($_POST['lastName'])) { $lastName = $_POST['lastName']; }
    if (isset($_POST['date'])) { $date = $_POST['date']; }
    if (isset($_POST['phoneNumber'])) { $phoneNumber = $_POST['phoneNumber']; }
    if (isset($_POST['speciality'])) { $speciality = $_POST['speciality']; }
    if (isset($_POST['roomNumber'])) { $roomNumber = $_POST['roomNumber']; }
    if (isset($_POST['address'])) { $address = $_POST['address']; }
    //if (isset($_POST[''])) { $ = $_POST['']; }
    $formErrors = false;
    //errors
    if ($date === '') :
		$err_date = '<div class="error">Sorry, date is a required field</div>';
        $formErrors = true;
    endif;
    if ( !(preg_match('/(\d+)-(\d+)-(\d+)/', $date)) ) :
        $err_dateMatch = '<div class="error">Sorry, the date format is weird</div>';
        $formErrors = true;
        $formErrors2 = true;
	endif; // input field empty
    if ( !(preg_match('/[A-Za-z]+/', $firstName)) ) :
		$err_firstMatch = '<div class="error">Sorry, the name formate is incorrect</div>';
        $formErrors = true;
	endif; // pattern doesn't match
    if ($firstName === '') :
		$err_first = '<div class="error">Sorry, first name is a required field</div>';
        $formErrors = true;
	endif; // input field empty
    
    if ( !(preg_match('/[A-Za-z]+/', $lastName)) ) :
		$err_lastMatch = '<div class="error">Sorry, the name formate is incorrect</div>';
        $formErrors = true;
	endif; // pattern doesn't match
    if ($lastName === '') :
		$err_last = '<div class="error">Sorry, first name is a required field</div>';
        $formErrors = true;
	endif; // input field empty
    if ( !(preg_match('/^[0-9]{5,50}$/', $licenseNumber)) ) :
		$err_licenseMatch = '<div class="error">Sorry, the license formate is incorrect</div>';
        $formErrors = true;
	endif; // pattern doesn't match
    if ($licenseNumber === '') :
		$err_license = '<div class="error">Sorry, license number is a required field</div>';
        $formErrors = true;
	endif; // input field empty
    
    if ( !(preg_match('/\d{10}/', $phoneNumber)) ) :
		$err_phoneNumberMatch = '<div class="error">Sorry, the phone number formate is incorrect</div>';
        $formErrors = true;
	endif; // pattern doesn't match
    if ($phoneNumber === '') :
		$err_phoneNumber = '<div class="error">Sorry, phone number is a required field</div>';
        $formErrors = true;
	endif; // input field empty
    
    if ( !(preg_match('/^[0-9]{1,5}$/', $roomNumber)) ) :
		$err_roomNumberMatch = '<div class="error">Sorry, the room number formate is incorrect</div>';
        $formErrors = true;
	endif; // pattern doesn't match
    if ($roomNumber === '') :
		$err_license = '<div class="error">Sorry, room number is a required field</div>';
        $formErrors = true;
	endif; // input field empty
    //
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        ul {
            list-style-type: none;
            list-style: none;
        }
        li {
            list-style-type: none;
            list-style: none;
        }
        .error {
            color: red;
        }
        .top {
            margin: auto;
            border-radius: 5px;
            width: 50%;
            background-color: gray;
        }
        .submitted {
            margin: auto;
            border-radius: 5px;
            width: 50%;
            background-color: blue;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
<h1><div class='submitted'>Doctor Profile</div></h1>

<div class='top'><form name="myForm" id="myForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"?>
    <ul>
        <li>
            <label for="licenseNumber">License Number *</label>
            <input type="text" name="licenseNumber" id="licenseNumber" placeholder="xxxxxxxx" value="<?php if (isset($licenseNumber)) { echo $licenseNumber; } ?>"  />
            <?php if(isset($err_license)) { echo $err_license; } ?>
            <?php if(isset($err_licenseMatch)) { echo $err_licenseMatch; } ?>
        </li>
        <li>
            <label for="firstName">First Name *</label>
            <input type="text" name="firstName" id="firstName" placeholder="First Name" value="<?php if (isset($firstName)) { echo $firstName; } ?>"  />
            <?php if(isset($err_first)) { echo $err_first; } ?>
            <?php if(isset($err_firstMatch)) { echo $err_firstMatch; } ?>
        </li> 
        <li>
            <label for="lastName">Last Name *</label>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php if (isset($lastName)) { echo $lastName; } ?>"  />
            <?php if(isset($err_last)) { echo $err_last; } ?>
            <?php if(isset($err_lastMatch)) { echo $err_lastMatch; } ?>
        </li> 
        <li>
            <label for="date">Date of Birth *</label>
            <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" value="<?php if (isset($date)) { echo $date; } ?>"  />
            <?php if(isset($err_date)) { echo $err_date; } ?>
            <?php if(isset($err_dateMatch)) { echo $err_dateMatch; } ?>
        </li>
        <li>
            <label for="phoneNumber">Work Phone *</label>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="1234567890" value="<?php if (isset($phoneNumber)) { echo $phoneNumber; } ?>"  />
            <?php if(isset($err_phoneNumber)) { echo $err_phoneNumber; } ?>
            <?php if(isset($err_phoneNumberMatch)) { echo $err_phoneNumberMatch; } ?>
        </li>
        <li>
            <label for="speciality">Speciality * </label>
            <select name="speciality" id="speciality">
                <option value="General Physician">General Physician</option>
                <option value="Heart Specialist">Heart Specialist</option>
                <option value="Eye Physician">Eye Physician</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Gynecologist">Gynecologist</option>
            </select>
            <?php if(isset($err_speciality)) { echo $err_speciality; } ?>
        </li>
        <li>
            <label for="roomNumber">Room Number *</label>
            <input type="text" name="roomNumber" id="roomNumber" placeholder="123" value="<?php if (isset($roomNumber)) { echo $roomNumber; } ?>"  />
            <?php if(isset($err_roomNumber)) { echo $err_roomNumber; } ?>
            <?php if(isset($err_roomNumberMatch)) { echo $err_roomNumberMatch; } ?>
        </li>
        <li>
            <label for="address">Home Address *</label>
            <input type="text" name="address" id="address" placeholder="123 Main Street, Atlanta GA 30318" value="<?php if (isset($address)) { echo $address; } ?>"  />
            <?php if(isset($err_address)) { echo $err_address; } ?>
            <?php if(isset($err_addressMatch)) { echo $err_addressMatch; } ?>
        </li>
        
    </ul>
    <button type="submit" name="action" value="submit">Create Profile</button>
</form></div>
<?php
    $Username = $_SESSION['username'];
    $emptyValues = true;
    if ($licenseNumber != '' && $date != '' && $firstName != '' && $lastName != '' && $phoneNumber != '' && $speciality != '' && $roomNumber != '' && $address != '') {
        $emptyValues = false;
    }
    $con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //end "connect to the database code
    //start of insert into Database code
    //If there is an error, don't submit the form!
    if($_REQUEST['action'] == 'submit') {
        if (!($formErrors) && !($emptyValues)) {
            $sql="INSERT INTO Doctor(License_number, Username, First_name, Last_name, Date_of_birth,  room_number, specialty, work_phone, home_address) 
            VALUES ('$licenseNumber', '$Username', '$firstName', '$lastName', '$date', '$roomNumber', '$speciality', '$phoneNumber', '$address');";
                if (!mysqli_query($con,$sql))
                {
                    die('Error: ' . mysqli_error($con));
                }
                $truth = true;
                echo "<div class='submitted'>Entry was added!</div>";
				header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/Availabilty");
            //end insert into database code
        } //End of formErrors 
    }// submit the top half of the form
    mysqli_close($con); //close the database connection
?>
</body>
</html>