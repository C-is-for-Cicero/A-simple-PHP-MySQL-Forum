<?php
//create_cat.php
include 'database.php';
include 'header.php';

$sql = "SELECT
                        topic_id,
                        topic_subject
                FROM
                        topics
                WHERE
                        topics.topic_id = " . $_GET['id'];
                        
$result = mysqli_query($connect_database, $sql);

if(!$result)
{
        echo '<br><font style="font-size: 14px;">The topic could not be displayed, please try again later.</font><br><br>';
}
else
{
        if(mysqli_num_rows($result) == 0)
        {
                echo '<br><font style="font-size: 14px;">This topic doesn&prime;t exist.</font><br><br>';
        }
        else
        {
                while($row = mysqli_fetch_assoc($result))
                {
                        //display post data
                        echo '<table class="topic" border="1">
                                        <tr>
                                                <th colspan="4">' . $row['topic_subject'] . '</th>
                                        </tr>';
                
                        //fetch the posts from the database
                        $posts_sql = "SELECT
                                                posts.post_id,
                                                posts.post_topic,
                                                posts.post_content,
                                                posts.post_date,
                                                posts.post_by,
                                                posts.file_name,
                                                posts.poll_title,
                                                users.user_id,
                                                users.user_name
                                        FROM
                                                posts
                                        LEFT JOIN
                                                users
                                        ON
                                                posts.post_by = users.user_id
                                        WHERE
                                                posts.post_topic = " . $_GET['id'];
                                                
                        $posts_result = mysqli_query($connect_database, $posts_sql);
                        
                        
                        
                                        $polls_sql = "SELECT
                                                poll_answers.id,
                                                poll_answers.title,
                                                poll_answers.poll_id,
                                                poll_answers.votes
                                        FROM
                                                poll_answers";
                                                
                        
                        $polls_result = mysqli_query($connect_database, $polls_sql);
                        $my_arary = array();

                        
                        
                        
                        
                        
                        
                        if(!$posts_result)
                        {
                                echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
                        }
                        else
                        {
                        
                                while($posts_row = mysqli_fetch_assoc($posts_result))
                                {
                                        echo '<tr class="topic-post">;
                                                        <td class="user-post" width="10%"><font style="font-size: 14px;">' . $posts_row['user_name'] . '<br>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</font></td>
                                                        <td width=10% class="post-content"width="15%"><pre style="font-size: 14px;">' . stripslashes(htmlentities($posts_row['post_content'])) . '</pre></td>
                                                        <td> <img src = "images/'.$posts_row['file_name'].'" style="width:150px;height:150px;" /> </td>';
                                        echo    '<td width=20%> ' . $posts_row['poll_title'] . ' <br> ';
                                        
                                        $id=$posts_row['post_id']-1;
                                        
                                                $polls_sql = "SELECT
                                                        poll_answers.id,
                                                        poll_answers.title,
                                                        poll_answers.poll_id,
                                                        poll_answers.votes
                                                FROM
                                                        poll_answers
                                                WHERE poll_answers.poll_id=     $id
                                                        ";
                                                
                        
                                                $polls_result = mysqli_query($connect_database, $polls_sql);

                                                        while($polls_row = mysqli_fetch_assoc($polls_result)){
                                                        $my_arary[] = $polls_row;
                                                        $name=$polls_row['id'];

                                                        echo '<form method="post" enctype=”multipart/form-data”>';
                                                        
                                                        echo '<input type="radio" name="option' . $polls_row['id'] . '" value=1>';
                                                        echo '<label for="option' . $polls_row['id'] . '">'.$polls_row['title'].'</label>';
                                                        
                                                        
                                                        $current_votes=$polls_row['votes'];

                                                        

                                                        /* if the radio button is pressed the current value  radio button must have a name corresponding to its id we need to update the value of the id votes by current vote plus the value of a vote
                                                        when submit is pressed the value of the radio button must be added to the current votes*/
                                                        if (isset($_POST['Submit' . $posts_row['post_id'] . ''])) {
                                                                if(isset($_POST['option' . $polls_row['id'] . '']))
                                                        {               
                                                                        $i=$polls_row['id'];
                                                                        $v=$current_votes+$_POST['option' . $polls_row['id'] . ''];
                                                                        $sql4="UPDATE poll_answers
                                                                                        SET votes=$v
                                                                                        WHERE id=$i
                                                                                        ";
                                                                        
                                                                        
                                                                        $vote_results = mysqli_query($connect_database, $sql4);         

                                                        }
                                                        }

                                                        

                                                        echo '<br>';

                                                        
                                                        
                                                        }
                                                echo '<input type="submit" name = "Submit' . $posts_row['post_id'] . '" value="Submit">';
                                                
                                                    echo '<br>';
													echo '<br>';
                                                        echo "Results";
                                                        echo '<br>';
                                                        
                                                        
                                                $polls_sql2 = "SELECT
                                                        poll_answers.id,
                                                        poll_answers.title,
                                                        poll_answers.poll_id,
                                                        poll_answers.votes
                                                FROM
                                                        poll_answers
                                                WHERE poll_answers.poll_id=     $id
                                                        ";
                                                
                        
                                                $polls_result2 = mysqli_query($connect_database, $polls_sql2);
                                                        
                                                        
                                                $my_arary2 = array();   
                                                        
                                                while($polls_row2 = mysqli_fetch_assoc($polls_result2)){
                                                        $c=$polls_row2['poll_id'];
                                                        echo $polls_row2['title'];
                                                        $sql5="SELECT 
                                                                        SUM(poll_answers.votes) AS s
                                                                FROM 
                                                                        poll_answers
                                                                WHERE
                                                                        poll_answers.poll_id=$c
                                                        
                                                        ";
                                                        $polls_result5 = mysqli_query($connect_database, $sql5);
                                                        while ($sum= mysqli_fetch_assoc($polls_result5)){
                                                                if($sum['s']==0){
																$res= 0;
                                                                $res= number_format((float)$res, 2, '.', '');
                                                                $res=$res*100;
                                                                echo " ";
																echo $res;
                                                                echo "%";
																}
																else{
																$res=$polls_row2['votes']/$sum['s'];
                                                                $res= number_format((float)$res, 2, '.', '');
                                                                $res=$res*100;
                                                                echo " ";
																echo $res;
                                                                echo "%";
                                                                }
                                                        }

                                                        //here we need to find the sum of the votes at any given poll id and divide the current vote id by this number SELECT SUM(votes) when pollanswers ID = current pollsrow poll id

                                                        echo '<br>';
                                                
                                                }
                                                        
                                                


                                                                                                
                                        echo '</td>';
                
                                        echo '</form>';
                                        echo '</tr>';
                                }
                        }
                        
                        

                        
                        
                        if(!isset($_SESSION['signed_in']))
                        {
                                echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
                        }
                        else
                        {
                                //show reply box
                                echo '<tr><td colspan="2"><font style="font-size: 18px;">Reply:</font><br>';
                                echo 'Post reply content here';
                            echo '<form method="post" action="reply.php?id=' . $row['topic_id'] . '", enctype = "multipart/form-data">';
                                echo '<textarea style="resize:none;" name="reply-content" rows="10" cols="70" wrap="pyhsical"></textarea><br /><br />';
                                echo 'Input poll question here:';
                                echo '<textarea style="resize:none;" name="poll-questions" rows="5" cols="70" wrap="pyhsical"></textarea><br /><br />';
                                echo 'Input poll options here(seperated by new line):';
                                echo '<textarea style="resize:none;" name="poll-options" rows="5" cols="70" wrap="pyhsical"></textarea><br /><br />';
                                echo '<input type="file" name="image"/>';
                                echo '<input type="submit" value="Submit reply" />';
                                echo '</form></td></tr>';

                        }
                        
                        //finish the table
                        echo '</table>';
                }
        }
}

include 'footer.php';
mysqli_close($connect_database);
?>
<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title></title>
  </head>
  <body></body>
</html>
