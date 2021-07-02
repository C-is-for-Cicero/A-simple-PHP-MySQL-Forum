<?php
//signup.php
include 'database.php';
include 'header.php';

echo '<font style="font-size: 18px;">Sign up</font><br><br>';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="">
 	 	<font style="font-size: 14px;">Username: </font><input type="text" name="user_name"></input><br><br>
 		<font style="font-size: 14px;">Password: </font><input type="password" name="user_pass"></input><br><br>
		<font style="font-size: 14px;">Password again: </font><input type="password" name="user_pass_check"></input><br><br>
		<font style="font-size: 14px;">E-mail: </font><input type="email" name="user_email"></input><br><br>
 		<input type="submit" value="Join here"></input>
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = '<br><font style="font-size: 14px;">The username can only contain letters and digits.</font><br><br>';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = '<br><font style="font-size: 14px;">The username cannot be longer than 30 characters.</font><br><br>';
		}
	}
	else
	{
		$errors[] = '<br><font style="font-size: 14px;">The username field must not be empty.</font><br><br>';
	}
	
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = '<br><font style="font-size: 14px;">The two passwords did not match.</font><br><br>';
		}
	}
	else
	{
		$errors[] = '<br><font style="font-size: 14px;">The password field cannot be empty.</font><br><br>';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo '<br><font style="font-size: 14px;">Uh-oh.. a couple of fields are not filled in correctly..</font><br><br>';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . $_POST['user_name'] . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . $_POST['user_email'] . "',
						NOW(),
						0)";
						
		$result = mysqli_query($connect_database, $sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo '<br><font style="font-size: 14px;">Succesfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)</font><br><br>';
		}
	}
}

include 'footer.php';
mysqli_close($connect_database);
?>
