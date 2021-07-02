<?php
//create_cat.php
include 'database.php';
include 'header.php';

$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_id, categories.cat_name, categories.cat_description";

$result = mysqli_query($connect_database, $sql);


if(!$result)
{
	echo '<br><font style="font-size: 14px;">The categories could not be displayed, please try again later.</font><br><br>';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo '<br><font style="font-size: 14px;">No categories defined yet.</font><br><br>';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		while($row = mysqli_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<font style="font-size: 18px;"><a href="category.php?id=' . $row['cat_id'] . '">' . stripslashes($row['cat_name']) . '</a></font><br><font style="font-size: 14px;">' . stripslashes($row['cat_description']) . '</font>';
				echo '</td>';
				echo '<td class="rightpart">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysqli_query($connect_database, $topicsql);
				
					if(!$topicsresult)
					{
						echo '<br><font style="font-size: 14px;">Last topic could not be displayed.</font><br><br>';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo '<font style="font-size: 14px;">no topics</fonts>';
						}
						else
						{
							while($topicrow = mysqli_fetch_assoc($topicsresult))
							echo '<font style="font-size: 14px;"><a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a><br> at ' . date('d-m-Y H:i', strtotime($topicrow['topic_date'])) . '</font>';
						}
					}
				echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
}

include 'footer.php';
mysqli_close($connect_database);
?>
