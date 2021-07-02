<?php
//create_cat.php
include 'database.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo '<br><font style="font-size: 14px;">This file cannot be called directly.</font><br><br>';
}
else
{
	//check for sign in status
	if(!isset($_SESSION['signed_in']))
	{
		echo '<br><font style="font-size: 14px;">You must be signed in to post a reply.</font><br><br>';
	}
	else
	{
				$msg = "";
		  	// Get image name
  	$image = $_FILES['image']['name'];
  	$image = hash_file('sha256',$_FILES['image']['tmp_name']);
	// image file directory
  	$target = "images/".basename($image);
	
	

	$poll_id1=mysqli_query($connect_database,"SELECT MAX(posts.post_id) FROM posts");
	$poll_id = mysqli_fetch_array($poll_id1, MYSQLI_NUM);
	echo $poll_id[0];
	
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by,
						  file_name,poll_title) 
				VALUES ('" . addslashes($_POST['reply-content']) . "',
						NOW(),
						" . $_GET['id'] . ",
						" . $_SESSION['user_id'] . ",'$image','" . addslashes($_POST['poll-questions']) . "')";
						
		$result = mysqli_query($connect_database, $sql);
		
		$answers = isset($_POST['poll-options']) ? explode(PHP_EOL, $_POST['poll-options']) : '';
		

		

		
		foreach($answers as $key) {
				
			$sql2 = "INSERT INTO 
				poll_answers (title,poll_id) 
			VALUES ('$key',$poll_id[0])";
		
			$result2 = mysqli_query($connect_database, $sql2)or die (mysqli_error($connect_database));;		
	
	
		
		}
		

	
	
	
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
						
		if(!$result)
		{
			echo '<br><font style="font-size: 14px;">Your reply has not been saved, please try again later.</font><br><br>';
		}
		else
		{
			echo '<br><font style="font-size: 14px;">Your reply has been saved, check out <a href="topic.php?id=' . $_GET['id'] . '">the topic</a>.</font><br><br>';
		}
	}
	
	
	
	
	
	
}

include 'footer.php';
mysqli_close($connect_database);
?>