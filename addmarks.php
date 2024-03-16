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
    <h1 class="heading">Add Marks</h1>
    <div class="Form">
        <form name="myform" method="post" action="addmarks.php" onsubmit = "return validateForm();">   
            <pre>Test Name: <input type="text" name="testname" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Add Marks"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $testname=$_POST['testname'];

            $sql="select * from tcourse where tusername='$userid';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            $cid=$row['cid'];
            $cname=$row['cname'];
            $sql="select * from marks where cid='$cid' and testname='$testname';";
            $check=mysqli_query($conn, $sql);
            $row=mysqli_fetch_array($check);
            if($row==NULL){
                $sql="select * from scourse where cid='$cid'";
                $check=mysqli_query($conn, $sql);
                $row=mysqli_fetch_array($check);
                if($row==NULL){
                    echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>No student registered in the course</div>";
                }
                else{
                    ?>
                    <form name='forward' action="markmarks.php" method="post" id="forward1">
                    <input type="hidden" name="userid" value='<?php echo $userid; ?>'>
                    <input type="hidden" name="testname" value='<?php echo $testname; ?>'>
                    <input type="hidden" name="cname" value='<?php echo $cname; ?>'>
                    <input type="hidden" name="cid" value='<?php echo $cid; ?>'>
                    <!-- <input sytle="display:none;" type="submit" value="submit"> -->
                    </form>
                    <script>
                        document.forward.submit();
                    </script>
                    <?php
                }
            }
            else{
                echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Marks Already given</div>";   
            }
            
        }
        ?>
    </div>   
</body>
</html>