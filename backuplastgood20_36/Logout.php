<?php
//start session to destroy it
session_start();
//destroy the session
session_destroy();
//goto index page
header("Location: https://academic-php.cc.gatech.edu/groups/cs4400_Group_20/");
?>