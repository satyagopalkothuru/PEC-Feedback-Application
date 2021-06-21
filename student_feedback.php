<?php
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "feedback_app";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PEC Online Feedback Form</title>
        <link rel="stylesheet" href="css/feedback.css">
    </head>
    <body>
        <header>
            <div>
                <img src="images/logo.png" alt="PEC logo">
                <img src="images/naac-logo.png" alt="Naac">
            </div>
        </header>
        <h1>Online Feedback Form - Student Portal</h1>
        <form method="post">
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
                <tr>
                    <td>Subject : </td>
                    <td>
                        <select name="subject">
                                <?php
                                     if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $result = mysqli_query($conn,"SELECT distinct subject FROM faculty where year='".$_post['year']."' and branch='".$_POST['branch']."' ");
                                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                        {
                                            
                                            echo "<option value='".$_POST['subject']."'>".$_POST['subject']."</option>";
                                            // echo "<td>" . $row['question'] . "</td>";
                                            // echo "<td><input type='radio' name='q1' value='4'></td>
                                            // <td><input type='radio' name='q1' value='3'></td>
                                            // <td><input type='radio' name='q1' value='2'></td>
                                            // <td><input type='radio' name='q1' value='1'></td>";
                                           
                                        }
                                    }

                                ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Faculty Name : </td>
                    <td>
                        <select name="facultyname">
                                <?php
                                     if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $result = mysqli_query($conn,"SELECT * FROM faculty where year='".$_post['year']."' and branch='".$_POST['branch']."' and subject='".$_POST['subject']."'");
                                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                        {
                                            
                                            echo "<option value='".$_POST['faculty_name']."'>".$_POST['faculty_name']."</option>";
                                            // echo "<td>" . $row['question'] . "</td>";
                                            // echo "<td><input type='radio' name='q1' value='4'></td>
                                            // <td><input type='radio' name='q1' value='3'></td>
                                            // <td><input type='radio' name='q1' value='2'></td>
                                            // <td><input type='radio' name='q1' value='1'></td>";
                                           
                                        }
                                    }

                                ?>
                              
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th></th>
                    <th>Excellent</th>
                    <th>Good</th>
                    <th>Average</th>
                    <th>Poor</th>
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
                                    echo "<td>" . $row['question'] . "</td>";
                                    echo "<td><input type='radio' name='q1' value='4'></td>
                                    <td><input type='radio' name='q1' value='3'></td>
                                    <td><input type='radio' name='q1' value='2'></td>
                                    <td><input type='radio' name='q1' value='1'></td>";
                                    echo "</tr>";
                                }
                            }
                    ?>
            </table>
           
            Comments : <br/>
            <textarea name="comments" cols="100%" rows="4"></textarea><br/>
            <input type="submit" value="Post">
        </form>
    </body>
</html>