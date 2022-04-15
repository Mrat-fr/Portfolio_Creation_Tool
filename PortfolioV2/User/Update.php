<?php include("UserNavbar.php"); 

if(isset($_POST['update'])){

    $fname=$_POST['fname'];
    $lanme=$_POST['lname'];
    $password=$_POST['pass'];
    $qury="UPDATE users SET FirstName='$name', LastName='$lanme', Password='$password' WHERE UserName='$user'";
    $update=mysqli_query($db, $qury);
    if($update) echo "<h3 class='text-center'>Details Updated</h3>";
}

if(isset($_POST["Upload"])){ 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("UPDATE users SET ProfilePicture = '$imgContent' WHERE UserName='$user'"); 
            if($insert){ 
                header("Refresh:0");
            }else{ 
                echo "<h3 class='text-center'>File upload failed, please try again</h3>";
            }  
        }else{ 
            echo "<h3 class='text-center'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload</h3>";
        } 
    }else{ 
        echo "<h3 class='text-center'>Please select an image file to upload</h3>";
    } 
} 

?>

<div class="container ">
    <h2 class="text-center">Personal Details </h2>
    <br>
    <div class="col">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($UINFO['ProfilePicture']); ?>" class="rounded mx-auto d-block" style="width:350px; height:350px; border:2px solid black;"/> 
        
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Proflie Picture:</label>
                <div class="col-sm-10">          
                    <input type="file" name="image">
                    <input class="btn btn-dark bg-dark"  type="submit" name="Upload" value="Upload">
                </div>
            </div>
        </form>

        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="fname" value="<?php echo $UINFO['FirstName'];?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lname" value="<?php echo $UINFO['LastName'];?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" value="<?php echo $UINFO['Email'];?>" disabled="disabled">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" name="pass" value="<?php echo $UINFO['Password'];?>" required>
                </div>
            </div>

            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-dark bg-dark" name="update">Update</button>
            </div>
            </div>
        </form>
    </div>
</div>  

  
  
<br><br><br><br><br><br><br><br>
<?php require("../Footer.php");?>