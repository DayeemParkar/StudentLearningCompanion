<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "slc";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>