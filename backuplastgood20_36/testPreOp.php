<script>
function myFunction()
{
document.getElementById("demo").innerHTML = Date();
}
</script>
<?php
	$con=mysqli_connect("academic-mysql.cc.gatech.edu","cs4400_Group_20","UwBacqAh","cs4400_Group_20");
$query10 = "SELECT DISTINCT Preoperative_medications, Surgery_CPT_code FROM Preoperative_Medications";
$result10 = mysqli_query($con,$query10);
$arrCount = 0;
while($row10 = mysqli_fetch_array($result10)) 
{
	if ($procArray[$row10['Surgery_CPT_code']] != '') 
	{
		$procArray[$row10['Surgery_CPT_code']] = $procArray[$row10['Surgery_CPT_code']]. ",".$row10['Preoperative_medications'];
	}
	else {
		$procArray[$row10['Surgery_CPT_code']] = $row10['Preoperative_medications'];
	}
}
foreach ($procArray as $val => $v)
{
	echo $val;
	echo $v;
	echo "<br><br><p id='demo'></p><button type='button' onclick='myFunction()'>Try it</button>";
}
?>