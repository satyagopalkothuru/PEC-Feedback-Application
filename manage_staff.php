
<?php
  
  $servername = "localhost";
  $username = "root";
  $password = "12345";
  $dbname = "feedback_app";
  
  $conn = mysqli_connect($servername,$username,$password,$dbname);
    
  // Checking connection
  if($conn === false)
  {
      die("ERROR: Could not connect. ". mysqli_connect_error());
  }
    
  // Taking faculty details from the form data
    if(isset($_POST['year']) && $_POST['year']!=0)
    {
        $faculty_id =  $_POST['faculty_id'];
        $faculty_name =  $_POST['faculty_name'];
        $subject = $_POST['subject'];
        $year =  $_POST['year'];
        $branch = $_POST['branch'];

        // Performing insert query 
        $sql = "INSERT INTO faculty  VALUES ('$faculty_id','$faculty_name','$year','$branch','$subject')";
        
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully.</h3>";  
        } 
        else
        {
            echo "ERROR: Sorry $sql. ". mysqli_error($conn);
        }
    }
?>
  
  
  <!DOCTYPE html>
  <html>
      <head>
          <title>Admin Manage Staff</title>
          <link rel="stylesheet" href="css/feedback.css">
      </head>
      <body>
          <h1>Admin - Manage Staff</h1>
          <form action="manage_staff.php" method="post">
              <table>
              <tr>
                      <td>Staff ID : </td>
                      <td><input type="number" name="faculty_id"></td>
                  </tr>
                  <tr>
                      <td>Staff Name : </td>
                      <td><input type="text" name="faculty_name"></td>
                  </tr>
                  <tr>
                      <td>Staff Subject :</td>
                      <td><input type="text" name="subject"></td>
                  </tr>
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
                      <td colspan="2"><input type="submit" value="Add Staff"></td>
                  </tr>
              </table>
          </form>
          <br>
          <h1>Available Faculty Details</h1>
          <table>
            <tr>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Year</th>
                <th>Branch</th>
                <th>Subject</th>
            </tr>
                  <?php
                        if($conn === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else
                        {
                            mysqli_select_db($conn,"feedback_app");
                            $result = mysqli_query($conn,"SELECT * FROM faculty");
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['facultyid'] . "</td>";
                                echo "<td>" . $row['faculty_name'] . "</td>";
                                echo "<td>" . $row['year'] . "</td>";
                                echo "<td>" . $row['branch'] . "</td>";
                                echo "<td>" . $row['subject'] . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
          </table>
      </body>
  </html>
  <?php
   // Close connection
   mysqli_close($conn);
   ?>
   