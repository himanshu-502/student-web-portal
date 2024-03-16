<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
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
    <h1 class="heading">Add a New Course</h1>
    <div class="Form">
        <form name="myform" method="post" action="addcourse.php" onsubmit = "return validateForm();">   
            <pre>Course Code:     <input type="text" name="ccode" required placeholder="enter course code"></pre>
            <pre>Course name:     <input type="text" name="cname" required placeholder="enter course name"><br></pre>
            <pre>Course duration: <input type="text" name="duration" required placeholder="enter course duration"><br></pre>
            <pre>Start date:      <input type="date" name="start" required><br></pre>
            <pre>End date:        <input type="date" name="end" required><br></pre>
            <pre>Total Seats:     <input type="number" name="seats" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Add Course"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $code=$_POST['ccode'];
            $name=$_POST['cname'];
            $dur=$_POST['duration'];
            $start=$_POST['start'];
            $end=$_POST['end'];
            $seats=$_POST['seats'];
            $sql="select * from course where cid='$code';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if($row==NULL)
            {
                $sql="insert into course values('$code', '$name', '$dur', '$start', '$end', '$seats', '$seats');";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Course Added</div>";
                }
                ?>  
                
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Course already added</div>";
        }
        ?>
    </div>   
</body>
</html>