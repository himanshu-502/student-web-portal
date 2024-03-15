<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
  $sql="select * from temp;";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $userid=$row['username'];
  $tables=mysqli_query($conn,"select * from fine where susername='$userid' order by fid;");
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
            $i=$i+1;
            if($i==1){
                ?>  
                        <tr>
                        <th>Sr.No.</th>
                        <th>Fee Amount</th>
                        <th>Description</th>
                        </tr>
                <?php
            }   
            ?>
                <tr>
                <td><?php echo $row['fid'];?> </td>
                <td><?php echo $row['amount'];?> </td>
                <td><?php echo $row['description'];?></td><br>
                </tr>
        <?php
        }
        ?>
        </table>


</body>
</html>