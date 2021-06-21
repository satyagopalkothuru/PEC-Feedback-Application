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
    if(isset($_POST['adminid']) && $_POST['adminid']!='')
    {
        $adminid =  $_POST['adminid'];
        $pswd =  $_POST['pswd'];
        echo $pswd;
        // retrive data
        $query="SELECT * FROM admin_table where admin_id='".$adminid."' and password='".$pswd."'";

        $sql=mysqli_query($conn,$query);  
        $numrows=mysqli_num_rows($sql); 

        if($numrows==1){
            echo "<h3>login successfully.</h3>"; 
            header("Location: /PEC Feedback/admin_home.php");
        } 
        else
        {
            echo "Enter valid login details";
        }
    }
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/feedback.css">
    </head>
    <body>
        <h1>Admin Login</h1>
        <form method="POST">
            <table>
                <tr>
                    <td>Admin ID : </td>
                    <td><input type="text" name="adminid"></td>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="pswd"></td>
                </tr>
                
            </table>
            <input type="submit" value="Login">
        </form>
    </body>
</html>