<?php
$conn= mysqli_connect("localhost","root","himanshu","webportal");
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
    <link rel="stylesheet" href="sign-in-form.css">
    <title>Form</title>
</head>
<body>
    <h1 class="heading">Add fine</h1>
    <div class="Form">
        <form name="myform" method="post" action="addfine.php" onsubmit = "return validateForm();">   
            <pre>Student ID:    <input type="text" name="id" required placeholder="enter Student ID"></pre>
            <pre>Fine Amount:   <input type="int" name="amt" required placeholder="enter fine amount"><br></pre>
            <pre>Description:   <input type="text" name="desc" placeholder="enter why the fine is imposed" required><br></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Impose Fine"></div>
            
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $amt=$_POST['amt'];
            $desc=$_POST['desc'];
            $sql="select * from student where susername='$id';";
            $check=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($check);
            if(!($row==NULL))
            {
                $sql="select max(fid) as fid from fine where susername='$id';";
                $result=mysqli_query($conn, $sql);
                if($row=mysqli_fetch_array($result)){
                    $fid=$row['fid']+1;
                }
                else {
                    $fid=1;
                }
                $sql="insert into fine values('$id', '$fid', '$amt', '$desc');";
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Fine Imposed</div>";
                }
                ?>  
                
                <?php
            }
            else
            echo "<div style='color:red;text-shadow:0px 0px 2px; text-align:center;'>There is no student with this id</div>";
        }
        ?>
    </div>   
</body>
</html>