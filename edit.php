<?php
$conn= mysqli_connect("localhost","root","database_password","database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $result=mysqli_query($conn, "select * from temp;");
  $row=mysqli_fetch_array($result);
  $userid=$row['username'];
  $type=$row['type'];
  if($type=="admin"){
    $row=mysqli_query($conn, "select * from admin where ausername='$userid';");
    $info=mysqli_fetch_array($row);
  }
  else if($type=="student"){
    $row=mysqli_query($conn, "select * from student where susername='$userid';");
    $info=mysqli_fetch_array($row);
  }
  else if($type=="teacher"){
    $row=mysqli_query($conn, "select * from teacher where tusername='$userid';");
    $info=mysqli_fetch_array($row);
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
    <h1 class="heading">Edit Details</h1>
    <div class="Form">
        <form name="myform" method="post" action="edit.php" onsubmit = "return validateForm();" enctype="multipart/form-data">   
            <pre>Name:    <input type="text" name="name" required value="<?php echo $info['name'];  ?>"><br></pre>
            <pre>Phone:   <input type="text" name="phone" required value="<?php echo $info['phone']; ?>"><br></pre>
            <pre>Address: <input type="text" name="address" required value="<?php echo $info['address']; ?>"><br></pre>
            <pre>Email:   <input type="text" name="email" required value="<?php echo $info['email']; ?>"><br></pre>
            <pre>Photo:   <input type="file" name="image"></pre>
            <div class="submitbutton"><input type="submit" name="submit" value="Edit Details"></div>
            
        </form>
        <?php
        
        if(isset($_POST['submit']))
        {
            $statusMsg = "File uploaded successfully"; 
            $status = 'error'; 
            if(!empty($_FILES["image"]["name"])) { 
                // Get file info 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
                // Allow certain file formats 
                $allowTypes = array('jpg','PNG','jpeg','gif', 'png', 'GIF', 'JPG', 'JPEG'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['image']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
         
                    // Insert image content into database 
                    $insert = mysqli_query($conn, "INSERT into images (image, username) VALUES ('$imgContent', '$userid')"); 
             
                    if($insert){ 
                        mysqli_query($conn, "delete from images where username='$userid'");
                        mysqli_query($conn, "INSERT into images (image, username) VALUES ('$imgContent', '$userid')");
                        mysqli_query($conn, "update login set photo=1 where username='$userid'");
                        $status = 'success'; 
                        $statusMsg = "File uploaded successfully."; 
                        echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Details Updated</div>";
                    }
                    else{ 
                        $statusMsg = "File upload failed, please try again."; 
                    }  
                }
                else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                } 
            }
            
            if($statusMsg=="File uploaded successfully"){
                $name=$_POST['name'];
                $phone=$_POST['phone'];
                $address=$_POST['address'];
                $email=$_POST['email'];
                if($type=="admin"){
                    mysqli_query($conn, "update admin set name='$name' where ausername='$userid';");
                    mysqli_query($conn, "update admin set phone='$phone' where ausername='$userid';");
                    mysqli_query($conn, "update admin set address='$address' where ausername='$userid';");
                    mysqli_query($conn, "update admin set email='$email' where ausername='$userid';");   
                }
                else if($type=="student"){
                    mysqli_query($conn, "update student set name='$name' where susername='$userid';");
                    mysqli_query($conn, "update student set phone='$phone' where susername='$userid';");
                    mysqli_query($conn, "update student set address='$address' where susername='$userid';");
                    mysqli_query($conn, "update student set email='$email' where susername='$userid';");
                    mysqli_query($conn, "update scourse set sname='$name' where susername='$userid';");
                    mysqli_query($conn, "update marks set sname='$name' where susername='$userid';");
                    mysqli_query($conn, "update attendance set sname='$name' where susername='$userid';");
                }
            
                else if($type=="teacher"){
                    mysqli_query($conn, "update teacher set name='$name' where tusername='$userid';");
                    mysqli_query($conn, "update teacher set phone='$phone' where tusername='$userid';");
                    mysqli_query($conn, "update teacher set address='$address' where tusername='$userid';");
                    mysqli_query($conn, "update teacher set email='$email' where tusername='$userid';");
                    mysqli_query($conn, "update tcourse set tname='$name' where tusername='$userid';");
                }

                echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>Details Updated</div>";

            }
            else{
                echo "<div style='color:green;text-shadow:0px 0px 2px;text-align:center;'>$statusMsg</div>";
            }
        }
        ?>
    </div>   
</body>
</html>



