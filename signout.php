<?php
//signout.php
include 'database.php';
//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
	include 'header.php';
	echo '<font style="font-size: 18px;">Sign out</font><br><br>';

	echo '<br><font style="font-size: 14px;">Succesfully signed out, thank you for visiting.</font><br><br>';
}
else
{
	include 'header.php';
	echo '<font style="font-size: 18px;">Sign out</font><br><br>';
	echo '<br><font style="font-size: 14px;">You are not signed in. Would you <a href="signin.php">like to</a>?</font><br><br>';
}

include 'footer.php';
mysqli_close($connect_database);
?>