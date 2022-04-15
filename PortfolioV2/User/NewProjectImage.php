<?php include("UserNavbar.php"); 
$project = $_GET['uid'];
if(isset($_POST["Upload"])){ 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("UPDATE portfolio SET Image = '$imgContent' WHERE PortfolioID='$project'"); 
            if($insert){ 
                header("Location: UserHome.php");
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

<div class="container">
    <h2 class="text-center">Project Infomation</h2>
    <br>
    <div class="col">        
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Project Image:</label>
                <div class="col-sm-10">          
                    <input type="file" name="image">
                    <input class="btn btn-dark bg-dark"  type="submit" name="Upload" value="CREATE">

                </div>
            </div>
        </form>

        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <form method="get" action="UserHome.php">
                    <button class="btn btn-dark bg-dark">SKIP</button>
                </form>
            </div>
        </div>
    </div>
</div>  

  
  
<br><br><br><br><br><br><br><br>
<?php require("../Footer.php");?>