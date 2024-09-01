<?php
$server = "localhost";
$userid = "root";
$pwd = "";
$dbname = "store";

$conn = new mysqli($server, $userid, $pwd, $dbname);

if($conn-> connect_error)
    die("Connection error".$conn->connect_error);


?>