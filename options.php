
<?php
$conn = mysqli_connect("localhost", "root", "himanshu", "webportal");
$sql=mysqli_query($conn, "select * from temp;");
$row=mysqli_fetch_array($sql);
$type=$row['type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<style>
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid green;
  padding: 9px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: yellow;
  color: black;
}
</style>

<body bgcolor="blue">
    <?php
    if($type=='admin'){
    ?>
        <a href="addcourse.php" target="frame3">add a course</a><br><br>
        <a href="removecourse.php" target="frame3">remove a course</a><br><br>
        <a href="addteacher.php" target="frame3">add a teacher</a><br><br>
        <a href="removeteacher.php" target="frame3">remove a teacher</a><br><br>
        <a href="addstudent.php" target="frame3">add a student</a><br><br>
        <a href="removestudent.php" target="frame3">remove a student</a><br><br>
        <a href="addfine.php" target="frame3">add fine to student</a><br><br>
        <a href="edit.php" target="frame3">Edit Details</a><br><br>
    <?php
    }
    else if($type=='student'){
    ?>
        <br>
       <a href="viewfee.php" target="frame3">view fees</a><br><br>
       <a href="viewmarks.php" target="frame3">view marks</a><br><br>
       <a href="viewattendance.php" target="frame3">view attendance</a><br><br>
       <a href="enroll.php" target="frame3">enroll in a course</a><br><br>
       <a href="viewcourses.php" target="frame3">view enrolled courses</a><br><br>
       <a href="edit.php" target="frame3">Edit Details</a><br><br>
    <?php
    }
    else if($type=='teacher'){
    ?>
        <a href="addmarks.php" target="frame3">add marks</a><br><br>
        <a href="updatemarks.php" target="frame3">Update Marks</a><br><br>
        <a href="viewstudent.php" target="frame3">View Students</a><br><br>
        <a href="addattendance.php" target="frame3">add attendance</a><br><br>
        <a href="updateattendance.php" target="frame3">Update attendance</a><br><br>
        <a href="edit.php" target="frame3">Edit Details</a><br><br>
    <?php
    }
    ?>
    <a href="sign-in-form.php" target="_top">Logout</a>
    
</body>
</html>