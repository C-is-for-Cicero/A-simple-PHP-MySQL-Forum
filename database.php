<?php 
session_start();
//database.php
include 'connect.php';
$connect_database = mysqli_connect($server, $username, $password, $database);
if(!mysqli_connect($server, $username, $password))
{
 	exit('Error: could not establish database connection');
}

?>