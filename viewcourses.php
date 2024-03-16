<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
  $sql="select * from temp;";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $userid=$row['username'];
  $tables=mysqli_query($conn,"select * from scourse where susername='$userid';");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    
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

    <table>

      <?php
      $i=0;
        while($row=mysqli_fetch_array($tables,MYSQLI_ASSOC))
        {   
            if($i==0){
                ?>  
                        <h2>Courses Enrolled: </h2>
                        <tr>
                        <th>Sr.No.</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Duration</th>
                        <th>From</th>
                        <th>To</th>
                        </tr>
                <?php
            }
            $cid=$row['cid'];
            $sql="select * from course where cid='$cid'";
            $query=mysqli_query($conn, $sql);
            $result=mysqli_fetch_array($query);
            $i=$i+1;   
            ?>
                <tr>
                <td><?php echo $i;?> </td>
                <td><?php echo $row['cid'];?> </td>
                <td><?php echo $row['cname'];?></td>
                <td><?php echo $result['duration'];?></td>
                <td><?php echo $result['start'];?></td>
                <td><?php echo $result['end'];?></td>
                </tr>
        <?php
        }
        ?>
        </table>


</body>
</html>