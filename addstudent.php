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
    <h1 class="heading">Register New Student</h1>
    <div class="Form">
        <form name="myform" method="post" action="addstudent.php" onsubmit = "return validateForm();">   
            <pre>Student ID:    <input type="text" name="id" required placeholder="enter Student ID"></pre>
            <pre>Student Name:  <input type="text" name="name" required placeholder="enter Student name"><br></pre>
            <pre>Phone Number:  <input type="text" name="phone" required placeholder="enter Phone number"><br></pre>
            <pre>Address:       <input type="text" name="address" placeholder="enter address" required><br></pre>
            <pre>E-mail:        <input type="text" name="mail" placeholder="email" required><br></pre>
            <pre>Password:      <input type="text" name="pwd" placeholder="enter password" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Register the Student"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $name=$_POST['name'];
            $phone=$_POST['phone'];
            $addr=$_POST['address'];
            $mail=$_POST['mail'];
            $pwd=$_POST['pwd'];
            $type="student";
            $sql="select * from login where username='$id';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if($row==NULL)
            {
                $sql="insert into login(username, pwd, type) values('$id', '$pwd', '$type');";
                mysqli_query($conn, $sql);
                $sql="insert into student values('$id', '$name', '$phone', '$addr', '$mail', '$pwd');";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Student Registered</div>";
                }
                ?>  
                
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Userid already registered</div>";
        }
        ?>
    </div>   
</body>
</html>