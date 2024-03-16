
<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    
</head>
<frameset rows="25%, *" noresize>
  <frame name="frame1" src="info.php">
  <frameset cols="15%, *" noresize>
    <frame name="frame2" src="options.php">
    <frame name="frame3" src="empty.php">
  </frameset>
</frameset>
</html>5