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
    <h1 class="heading">Register New Teacher</h1>
    <div class="Form">
        <form name="myform" method="post" action="addteacher.php" onsubmit = "return validateForm();">   
            <pre>Teacher ID:    <input type="text" name="id" required placeholder="enter Teacher ID"></pre>
            <pre>Teacher Name:  <input type="text" name="name" required placeholder="enter teacher name"><br></pre>
            <pre>Phone Number:  <input type="text" name="phone" required placeholder="enter Phone number"><br></pre>
            <pre>Address:       <input type="text" name="address" placeholder="enter address" required><br></pre>
            <pre>E-mail:        <input type="text" name="mail" placeholder="email" required><br></pre>
            <pre>Password:      <input type="text" name="pwd" placeholder="enter password" required><br></pre>
            <pre>Course taught: <input type="text" name="course" placeholder="enter the course id" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Register the Teacher"></div>
            
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
            $course=$_POST['course'];
            $type="teacher";
            $sql="select * from login where username='$id';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            $sql1="select * from course where cid='$course';";
            $check1=mysqli_query($conn, $sql1);
            $row1=mysqli_fetch_array($check1);
            if(!$row && $row1)
            {
                $cname=$row1['cname'];
                $sql="insert into login(username, pwd, type) values('$id', '$pwd', '$type');";
                mysqli_query($conn, $sql);
                $sql="insert into teacher values('$id', '$name', '$phone', '$addr', '$mail', '$pwd');";
                mysqli_query($conn, $sql);
                $sql="insert into tcourse values('$course', '$id', '$cname', '$name');";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Teacher Registered</div>";
                }
                
            }
            else if($row){
                echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Userid already registered</div>";
            }
            else if(!$row1){
                echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Course Does not exist</div>";
            }
        }
        ?>
    </div>   
</body>
</html>