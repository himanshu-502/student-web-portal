<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";
  $del=mysqli_query($conn, "delete from temp;");
  
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
    <h1 class="heading">Sign In</h1>
    <div class="Form">
        <form name="myform" method="post" action="sign-in-form.php" onsubmit = "return validateForm();">   
            <pre>UserID:   <input type="text" name="userid" required placeholder="Enter userid"></pre>
            <pre>Password:<input type="password" name="password" required placeholder="Enter Password"><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Login"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $userid=$_POST['userid'];
            $password=$_POST['password'];
            $sql="select * from login where username='$userid' AND pwd='$password';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if(!($row==NULL))
            {
                $user=$row['username'];
                $pwd=$row['pwd'];
                $type=$row['type'];
                $ins = mysqli_query($conn, "insert into temp values('$user','$pwd', '$type'); ");
                echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Login Successful</div>";
                ?>  
                <form name='forward' action="index.php" method="post" id="forward1">
                <input type="hidden" name="userid" value='<?php echo $userid?>'>
                <!-- <input sytle="display:none;" type="submit" value="submit"> -->
                </form>
                <script>
                    document.forward.submit();
                </script>
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Login Failed</div>";
        }
        ?>
    </div>   
</body>
</html>