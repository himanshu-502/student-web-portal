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
    <h1 class="heading">Remove Student</h1>
    <div class="Form">
        <form name="myform" method="post" action="removestudent.php" onsubmit = "return validateForm();">   
            <pre>Student ID:     <input type="text" name="id" required placeholder="enter Student ID"></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Remove Student"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $sql="select * from student where susername='$id';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if(!($row==NULL))
            {
                $sql="delete from marks where susername='$id';";
                mysqli_query($conn, $sql);
                $sql="delete from attendance where susername='$id';";
                mysqli_query($conn, $sql);
                $sql="delete from scourse where susername='$id';";
                mysqli_query($conn, $sql);
                $sql="delete from student where susername='$id';";
                mysqli_query($conn, $sql);
                $sql="delete from login where username='$id';";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Student de-registered</div>";
                }
                ?>  
                
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>There is no student with this id!!!</div>";
        }
        ?>
    </div>   
</body>
</html>