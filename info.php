<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>info</title>
</head>
<style>
p {
  text-align: center;
    font-family: sans-serif, "Helvetica Neue", "Lucida Grande", Arial;
  font-stretch: expanded;
}
div{
    column-gap: 10px;
    float: left;
}
.marginleft{
    margin-left: 100px;
}
.marginright{
    margin-right: 100px;
}
.container{
    margin-left:350px;
    margin-right: 300px;
}
</style>
<body bgcolor="cyan">
    <?php
    $sql="select * from temp;";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result);
    $userid=$row['username'];
    $type=$row['type'];
    ?>
    <div class="marginleft"><div><img src="img(7).jpeg" width="200px" height="150px"></div>
</div><?php
    if($type=="admin"){
        $sql="select * from admin where ausername='$userid';";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        ?>
       <div class="container"><div><p>Name: <?php echo $row['name']; ?></p>
        <p>Phone: <?php echo $row['phone']; ?></p>
        <p>Address: <?php echo $row['address']; ?></p>
        <p>Email: <?php echo $row['email']; ?></p>
    </div></div>
        <?php
    }
    else if($type=="teacher"){
        $sql="select * from teacher where tusername='$userid';";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        ?>
        <div class="container"><div>
        <p>Name: <?php echo $row['name']; ?></p>
        <p>Phone: <?php echo $row['phone']; ?></p>
        <p>Address: <?php echo $row['address']; ?></p>
        <p>Email: <?php echo $row['email']; ?></p>
        </div></div>
        <?php
    }
    else if($type=="student"){
        $sql="select * from student where susername='$userid';";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        ?>
        <div class="container"><div>
        <p>Name: <?php echo $row['name']; ?></p>
        <p>Phone: <?php echo $row['phone']; ?></p>
        <p>Address: <?php echo $row['address']; ?></p>
        <p>Email: <?php echo $row['email']; ?></p>
    </div></div>
        <?php
    }
    ?>
    <?php
    $phot=mysqli_query($conn, "select * from login where username='$userid';");
    $isphoto=mysqli_fetch_array($phot);
    if($isphoto['photo']=="1"){
        $phot=mysqli_query($conn, "select * from images where username='$userid'");
        $photo=mysqli_fetch_array($phot); 
        ?>
        <div class="marginright"><div><img width="200px" height="150px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($photo['image']); ?>" />
    </div></div>
        <?php
    }
    else{
        ?>
        <div class="marginright"><div><img src="default.png" width="200px" height="150px"></div></div>
<?php
    }
    ?>
</body>
</html>