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
  $tables=mysqli_query($conn,"select distinct cid as code, cname from attendance where susername='$userid';");
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
.card-container{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.flexContainer{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.flexContainer{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.card{
    align-items: center;
    justify-content: center;
    text-align: center;
}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 35%;
    border-radius: 5px;
    margin: 50px;
  }
  
  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
  
  .card img {
    border-radius: 5px 5px 0 0;
  }
  
  .container {
    padding: 2px 16px;
  }

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #ffdf00;}
</style>
</style>
<body>
    
      <div class="flexContainer">
      <?php
      
        while($row=mysqli_fetch_array($tables,MYSQLI_ASSOC))
        {
            ?>
            <div class="card">
                <div class="container">
            <p><?php echo "Course Code: ".$row['code']; ?></p><br>
            <p><?php echo "Course Name: ".$row['cname']; ?></p>
            <?php
            ?>  
            <table>
                <tr>
                    <th>Sr.No.</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                </tr>
            <?php
            $cid=$row['code']; 
            $att="select * from attendance where susername='$userid' and cid='$cid' order by attendancedate, start;";
            $attendancetable=mysqli_query($conn, $att);
            $i=0;
            while($attrow=mysqli_fetch_array($attendancetable))
            {
                $i=$i+1;
                ?>
                    <tr>
                    <td><?php echo "$i"; ?></td>
                    <td><?php echo $attrow['attendancedate'];?> </td>
                    <td><?php echo $attrow['start'];?> </td>
                    <td><?php echo $attrow['end'];?> </td>
                    <td><?php echo $attrow['status'];?></td><br>
                    </tr>
        <?php
        }
        ?>
        </table>
    </div></div>
    <?php
            
        }
        ?>
    </div>


</body>
</html>