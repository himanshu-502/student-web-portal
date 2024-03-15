<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
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
    <h1 class="heading">Add Attendance</h1>
    <div class="Form">
        <form name="myform" method="post" action="addattendance.php" onsubmit = "return validateForm();">   
            <pre>Date: <input type="date" name="date" required><br></pre>
            <pre>From: <input type="time" name="from" required><br></pre>
            <pre>To:   <input type="time" name="to" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Add Attendance"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $date=$_POST['date'];
            $from=$_POST['from'];
            $to=$_POST['to'];

            $sql="select * from tcourse where tusername='$userid';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            $cid=$row['cid'];
            $cname=$row['cname'];
            $sql="select * from attendance where cid='$cid' and attendancedate='$date' and start='$from' and end='$to';";
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
                    <form name='forward' action="markattendance.php" method="post" id="forward1">
                    <input type="hidden" name="userid" value='<?php echo $userid; ?>'>
                    <input type="hidden" name="date" value='<?php echo $date; ?>'>
                    <input type="hidden" name="from" value='<?php echo $from; ?>'>
                    <input type="hidden" name="cname" value='<?php echo $cname; ?>'>
                    <input type="hidden" name="to" value='<?php echo $to; ?>'>
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
                echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>Attendance already added</div>";   
            }
            
        }
        ?>
    </div>   
</body>
</html>