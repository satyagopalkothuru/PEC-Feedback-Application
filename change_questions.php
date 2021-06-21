<!DOCTYPE html>
<html>
    <head>
        <title>Admin Manage Question</title>
        <link rel="stylesheet" href="css/feedback.css">
    </head>
    <body>
        <h1>Admin - Manage Questions</h1>
        <form action="change_questions.php" method="post">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "12345";
                $dbname = "feedback_app";
            
                $conn = mysqli_connect($servername,$username,$password,$dbname);
                
                // Checking connection
                if($conn === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                
                // Taking faculty details from the form data
                if(isset($_POST['question_id']) && $_POST['question_id']!=0)
                {
                    $question_id =  $_POST['question_id'];
                    $new_question =  $_POST['new_question'];
                    
                    $query="SELECT * FROM questions where question_id='".$question_id."' and question='".$new_question."'";
                    $sql=mysqli_query($conn,$query);  
                    $numrows=mysqli_num_rows($sql);
                    if ($numrows==0)
                    {// Performing insert query 
                        $sql = "INSERT INTO questions  VALUES ('$question_id','$new_question')";
                        
                        if(mysqli_query($conn, $sql)){
                            echo    '<script type="text/javascript">
                                        alert("Added successfully");
                                    </script>';

                        } 
                        else
                        {
                            echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
                        }
                    }
                    else
                        {
                            echo    '<script type="text/javascript">
                                        alert("Already exists in the Database.");
                                    </script>';
                        }
                }
                
            ?>

            Question ID : <input type="number" name="question_id">
            New Question : <input type="text" name="new_question">
            <input type="submit" value="Add Question">
            
        </form>
        <br>
        <table>
            <tr>
                <th>Question ID</th>
                <th>Question</th>
            </tr>
                <?php
                        if($conn === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else
                        {
                            mysqli_select_db($conn,"feedback_app");
                            $result = mysqli_query($conn,"SELECT * FROM questions");
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['question_id'] . "</td>";
                                echo "<td>" . $row['question'] . "</td>";
                                echo "</tr>";
                            }
                        }
                ?>
        </table>
        <?php
            mysqli_close($conn);
        ?>
    </body>
</html>

