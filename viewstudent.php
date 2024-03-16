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
  $sql="select * from tcourse where tusername='$userid' ";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $cid=$row['cid'];
  $tables=mysqli_query($conn,"select * from scourse where cid='$cid';");
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
                        <h2>Students Enrolled: </h2>
                        <tr>
                        <th>Sr.No.</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        </tr>
                <?php
            }
            $sid=$row['susername'];
            $sql="select * from student where susername='$sid'";
            $query=mysqli_query($conn, $sql);
            $result=mysqli_fetch_array($query);
            $i=$i+1;   
            ?>
                <tr>
                <td><?php echo $i;?> </td>
                <td><?php echo $row['susername'];?> </td>
                <td><?php echo $row['sname'];?></td>
                <td><?php echo $result['phone'];?></td>
                <td><?php echo $result['address'];?></td>
                <td><?php echo $result['email'];?></td>
                </tr>
        <?php
        }
        ?>
        </table>


</body>
</html>