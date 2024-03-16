<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $result=mysqli_query($conn, "select * from temp;");
  $row=mysqli_fetch_array($result);
  $userid=$row['username'];
  $type=$row['type'];
  
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
    <h1 class="heading">Enroll Course</h1>
    <div class="Form">
        <form name="myform" method="post" action="enroll.php" onsubmit = "return validateForm();">   
            <pre>Course Code:     <input type="text" name="ccode" required placeholder="enter course code"></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Enroll"></div>
            
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
                $sql="select * from scourse where cid='$code' and susername='$userid'";
                $check=mysqli_query($conn, $sql);
                $row=mysqli_fetch_array($check);
                if($row==NULL){
                    $sql="select * from course where cid='$code';";
                    $result=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_array($result);
                    if($row['seatsleft']==0){
                        echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>No seats left in the course</div>";
                    }
                    else{
                        $sql1="select * from student where susername='$userid';";
                        $result1=mysqli_query($conn, $sql1);
                        $row1=mysqli_fetch_array($result1);
                        $cname=$row['cname'];
                        $sname=$row1['name'];
                        $sql="insert into scourse values('$code', '$userid', '$cname', '$sname');";
                        $result=mysqli_query($conn, $sql);
                        $sql="update course set seatsleft=seatsleft-1 where cid='$code';";
                        $result=mysqli_query($conn, $sql);
                        echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Course Enrolled</div>";
                    }
                }
                else  echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Course already enrolled</div>";
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