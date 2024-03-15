<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign-in-form.css">
    <title>Form</title>
</head>
<body>
    <h1 class="heading">Remove Course</h1>
    <div class="Form">
        <form name="myform" method="post" action="removecourse.php" onsubmit = "return validateForm();">   
            <pre>Course Code:     <input type="text" name="ccode" required placeholder="enter course code"></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Remove Course"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $code=$_POST['ccode'];
            $sql="select * from course where cid='$code';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if(!($row==NULL))
            {
                $sql="delete from marks where cid='$code';";
                mysqli_query($conn, $sql);
                $sql="delete from attendance where cid='$code';";
                mysqli_query($conn, $sql);
                $sql="delete from scourse where cid='$code';";
                mysqli_query($conn, $sql);
                $sql="delete from tcourse where cid='$code';";
                mysqli_query($conn, $sql);
                $sql="delete from course where cid='$code';";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Course removed</div>";
                }
                ?>  
                
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Course does not exist</div>";
        }
        ?>
    </div>   
</body>
</html>