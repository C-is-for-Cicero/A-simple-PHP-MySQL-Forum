<?php
//category.php
include 'database.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . $_GET['id'];

$result = mysqli_query($connect_database, $sql);

if(!$result)
{
	echo '<br><font style="font-size: 14px;">The category could not be displayed, please try again later.</font><br><font style="font-size: 14px;">' . mysql_error() . '</font><br>';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo '<br><font style="font-size: 14px;">This category does not exist.</font><br><br>';
	}
	else
	{
		//display category data
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<font style="font-size: 18px;">' . $row['cat_name'] . '</font><br>';
		}
	
		//do a query for the topics
		$get_id = $_GET['id'];
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = '$get_id'
				ORDER BY
					topic_date
				DESC";
		
		$result = mysqli_query($connect_database, $sql);
		
		if(!$result)
		{
			echo '<br><font style="font-size: 14px;">The topics could not be displayed, please try again later.</font><br><br>';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				echo '<br><font style="font-size: 14px;">There are no topics in this category yet.</font><br><br>';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = mysqli_fetch_assoc($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<font style="font-size: 14px;"><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br></font>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo '<font style="font-size: 14px;">' . date('d-m-Y H:i', strtotime($row['topic_date'])) . '</font>';
						echo '</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
	}
}

include 'footer.php';
mysqli_close($connect_database);
?>
