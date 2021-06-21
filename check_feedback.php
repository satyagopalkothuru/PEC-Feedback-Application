<!DOCTYPE html>
<html>
    <head>
        <title>Admin Check Feedback</title>
        <link rel="stylesheet" href="css/feedback.css">
    </head>
    <body>
        <h1>Admin Check Feedback</h1>
        <form action="check_feedback.php" method="POST">
            <table>
                <tr>
                    <td>Year : </td>
                    <td>
                        <select name="year">
                            <option value="1">First Year</option>
                            <option value="2">Second Year</option>
                            <option value="3">Third Year</option>
                            <option value="4">Fourth Year</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Branch : </td>
                    <td>
                        <select name="branch">
                            <option value="cse1">CSE-1</option>
                            <option value="cse2">CSE-2</option>
                            <option value="ece1">ECE-1</option>
                            <option value="ece2">ECE-2</option>
                            <option value="it">IT</option>
                            <option value="eee">EEE</option>
                            <option value="mech">MECH</option>
                            <option value="civil">CIVIL</option>
                        </select>
                    </td>
                </tr>
                
            </table>
            <input type="submit" value="Check">
        </form>
        <br>
        <table>
            
                <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "12345";
                        $dbname = "feedback_app";
                    
                        $conn = mysqli_connect($servername,$username,$password,$dbname);
                        
                        if($conn === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else
                        {
                            if(isset($_POST['year']) && isset($_POST['branch']) && $_POST['year']!=0)
                            {
                                mysqli_select_db($conn,"feedback_app");
                                $result = mysqli_query($conn,"SELECT distinct subject FROM feedback order by subject");
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    $ques_ids = mysqli_query($conn,"SELECT qid FROM feedback where subject ='".$row['subject']."'");
                                    echo "<h1>". $row['subject']."</h1>";
                                    echo "<table>";
                                        echo "<tr>";                                   
                                        echo "<th>Question</th>";
                                        echo "<th>Score</th>";
                                        echo "<th>A</th>";
                                        echo "<th>B</th>";
                                        echo "<th>C</th>";
                                        echo "<th>D</th>";
                                        echo "</tr>";
                                        while($record=mysqli_fetch_array($ques_ids,MYSQLI_ASSOC))
                                        {
                                            $questions=mysqli_query($conn,"SELECT question FROM questions where question_id ='".$record['qid']."'");
                                            $req_ques=mysqli_fetch_array($questions,MYSQLI_ASSOC);
                                            $other_feedback_data=mysqli_query($conn,"SELECT * FROM feedback where question_id ='".$record['qid']."' and subject='".$row['subject']."'");
                                            echo "<tr>";
                                            echo "<td>" . $req_ques['question'] . "</td>";
                                            echo "<td>" . $other_feedback_data['score'] . "</td>";
                                            echo "<td>" . $other_feedback_data['A'] . "</td>";
                                            echo "<td>" . $other_feedback_data['B'] . "</td>";
                                            echo "<td>" . $other_feedback_data['C'] . "</td>";
                                            echo "<td>" . $other_feedback_data['D'] . "</td>";
                                            echo "</tr>";
                                        }                                  
                                    echo "</table>";
                                    echo "<br>";
                                }
                            }
                        }
                        mysqli_close($conn);
                ?>
        </table>
    </body>
</html>