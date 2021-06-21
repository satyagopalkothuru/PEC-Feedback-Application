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
                if(isset($_POST['adminid']) && $_POST['new_pswd']!='')
                {
                    $admin_id =  $_POST['adminid'];
                    $old_pwd =  $_POST['old_pwd'];
                    $new_pwd = $_POST['new_pswd'];
                    $confirm_pwd = $_POST['confirm_pswd'];
                    if($new_pwd==$confirm_pwd)
                    {
                        $query="SELECT * FROM admin_table where admin_id='".$admin_id."' and password='".$old_pwd."'";
                        $sql=mysqli_query($conn,$query);  
                        $numrows=mysqli_num_rows($sql);
                        if ($numrows==1)
                        { 
                            
                            $sql = "UPDATE admin_table set password= '".$new_pwd."' where admin_id='".$admin_id."'";
                            if(mysqli_query($conn, $sql)){
                                echo    '<script type="text/javascript">
                                            alert("Updated successfully");
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
                                        alert("Details not exists");
                                    </script>';
                        }
                    }
                    else
                        {
                            echo    '<script type="text/javascript">
                                        alert("Confirm Password and New Password Must be same.");
                                    </script>';
                        }
                }
                else
                        {
                            echo    '<script type="text/javascript">
                                        alert("Please fill all details.");
                                    </script>';
                        }
                
                mysqli_close($conn);
        
            ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Change Password</title>
        <link rel="stylesheet" href="css/feedback.css">
    </head>
    <body>
        <h1>Admin - Change Password</h1>
        <form method="POST">
            <table>
                <tr>
                    <td>Admin ID : </td>
                    <td><input type="text" name="adminid"></td>
                </tr>
                <tr>
                    <td>Old Password : </td>
                    <td><input type="password" name="old_pwd"></td>
                </tr>
                <tr>
                    <td>New Password : </td>
                    <td><input type="password" name="new_pswd"></td>
                </tr>
                <tr>
                    <td>Confirm Password : </td>
                    <td><input type="password" name="confirm_pswd"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Update"></td>
                </tr>
            </table>
            
        </form>
    </body>
</html>