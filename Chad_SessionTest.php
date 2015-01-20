<?php
session_start();
// store session data
$_SESSION['username']='null';
?>

<html>
<body>

<?php
//retrieve session data
echo "username=". $_SESSION['username'];
?>

</body>
</html>
