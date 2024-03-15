<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $result=mysqli_query($conn, "select * from temp;");
  $row=mysqli_fetch_array($result);
  $userid=$_POST['userid'];
  $cid=$_POST['cid'];
  $date=$_POST['date'];
  $from=$_POST['from'];
  $cname=$_POST['cname'];
  $to=$_POST['to'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>

<body>
    <p>Course Code: <?php echo $cid; ?></p><br>
    <p>Course Name: <?php echo $cname; ?></p><br>
    <?php
    $sql="select * from attendance where cid='$cid' and attendancedate='$date' and start='$from' and end='$to' order by cid";
    $query=mysqli_query($conn, $sql);
    ?>
    <form action="markupdatedattendance.php" method="POST">
    <input type="hidden" name="userid" value='<?php echo $userid; ?>'>
    <input type="hidden" name="date" value='<?php echo $date; ?>'>
    <input type="hidden" name="from" value='<?php echo $from; ?>'>
    <input type="hidden" name="cname" value='<?php echo $cname; ?>'>
    <input type="hidden" name="to" value='<?php echo $to; ?>'>
    <input type="hidden" name="cid" value='<?php echo $cid; ?>'>
    <table>
        <tr>
            <th>Sr.No.</th>
            <th>Student id</th>
            <th>Student Name</th>
            <th>Status</th>
        </tr>
    <?php
    $i=0;
    while($row=mysqli_fetch_array($query)){
        $i=$i+1;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['susername']; ?></td>
                <td><?php echo $row['sname']; ?></td>
                <td><input type="text" name="<?php echo $row['susername']; ?>" value="<?php echo $row['status']; ?>" required></td>
            </tr>
        <?php
    }
    ?>
    </table>
    <input type="submit" name="submit" value="update">
</form>
    <?php
    if(isset($_POST['submit']))
    {
        $userid=$_POST['userid'];
        $cid=$_POST['cid'];
        $date=$_POST['date'];
        $from=$_POST['from'];
        $cname=$_POST['cname'];
        $to=$_POST['to'];
        $sql="select * from scourse where cid='$cid' order by cid";
        $query=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($query)){
            $sid=$row['susername'];
            $sql1="select name from student where susername='$sid'";
            $query1=mysqli_query($conn, $sql1);
            $row1=mysqli_fetch_array($query1);
            $sname=$row1['name'];
            $sidstatus=$_POST["$sid"];
            $update="update attendance set status='$sidstatus' where cid='$cid' and susername='$sid' and attendancedate='$date' and start='$from' and end='$to';";
            mysqli_query($conn, $update);
        }
        echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Attendance Updated</div>";
        ?>
        
        <form name='forward' action="markupdatedattendance.php" method="post" id="forward1">
        <input type="hidden" name="userid" value='<?php echo $userid; ?>'>
        <input type="hidden" name="date" value='<?php echo $date; ?>'>
        <input type="hidden" name="from" value='<?php echo $from; ?>'>
        <input type="hidden" name="cname" value='<?php echo $cname; ?>'>
        <input type="hidden" name="to" value='<?php echo $to; ?>'>
        <input type="hidden" name="cid" value='<?php echo $cid; ?>'>
        <!-- <input sytle="display:none;" type="submit" value="submit"> -->
    </form>
    <script>
        const sleep = async () => {
            await new Promise(res => {
                setTimeout(res, 5000)
            })
        }
        sleep();
        document.forward.submit();
    </script>
    <?php
    }
    
    ?>

</body>
</html>