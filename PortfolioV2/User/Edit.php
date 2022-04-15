<?php include("UserNavbar.php"); 
$bgimagemess = $ppimagemess = $BGimage = $Texttitle = $Texttext = $video = $title = "";
$proname = $_GET['uid'];
$pro = $db->query("SELECT * FROM portfolio WHERE PortfolioID='$proname'"); 
$rowcount=mysqli_num_rows($pro);
if($rowcount>0){ 
    $PINFO=mysqli_fetch_array($pro);
    $BGimage = $PINFO['Background'];
    $title = $PINFO['Title'];
    $Texttext = $PINFO['TextText'];
    $video = $PINFO['Video'];
}

//images
$posts = $db->query("SELECT * FROM portfolioimages WHERE PortfolioID='$proname'"); 
$prowcount=mysqli_num_rows($posts);
if($prowcount>0){
  while ($Irow = mysqli_fetch_array($posts)) {
    $Postarray[] = $Irow;
  }
} 

//background image
if(isset($_POST["bgUpload"])){ 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("UPDATE portfolio SET Background = '$imgContent' WHERE PortfolioID='$proname'"); 
            if($insert){ 
                header("Refresh:0");
            }else{ 
                $bgimagemess="File upload failed, please try again";
            }  
        }else{ 
            $bgimagemess="<h3 class='text-center'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload";
        } 
    }else{ 
        $bgimagemess="Please select an image file to upload";
    } 
} 

//gallary image
if(isset($_POST["pUpload"])){ 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("INSERT INTO portfolioimages (PortfolioID,Image) values ('$proname','$imgContent')"); 
            if($insert){ 
                header("Refresh:0");
            }else{ 
                $bgimagemess="File upload failed, please try again";
            }  
        }else{ 
            $bgimagemess="<h3 class='text-center'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload";
        } 
    }else{ 
        $bgimagemess="Please select an image file to upload";
    } 
} 

if(isset($_POST['update'])){
    $Title=$_POST['Title'];
    $qury="UPDATE portfolio SET Title='$Title' WHERE PortfolioID='$proname'";
    $update=mysqli_query($db, $qury);
    header("Refresh:0");
}

if(isset($_POST['Deletevid'])){
    $em = "";
    $qury="UPDATE portfolio SET Video='$em' WHERE PortfolioID='$proname'";
    $update=mysqli_query($db, $qury);
    header("Refresh:0");
}

if(isset($_POST['Tupdate'])){
    $Title=$_POST['Title'];
    $qury="UPDATE portfolio SET TextText='$Title' WHERE PortfolioID='$proname'";
    $update=mysqli_query($db, $qury);
    header("Refresh:0");
}

if(isset($_POST['VUpload'])){
    $code=$_POST['video'];
    $video = "https://www.youtube.com/embed/".$code;
    $qury="UPDATE portfolio SET Video='$video' WHERE PortfolioID='$proname'";
    $update=mysqli_query($db, $qury);
    header("Refresh:0");
}
if(isset($_POST['view'])){
    header("/PortfolioV2/View.php?uid=.$proname");
}

?>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<div class="flexbox-contanier">
<!-- -----------------------------------------------------------------------------------toolbar----------------------------------------------------------------------------------- -->
    <div class="flexbox-toolbar"><br>
        
        <form method="post" enctype="multipart/form-data">
            <lable>background</lable>
            <input type="file" name="image">
            <input  type="submit" name="bgUpload" value="Upload"><br>
            <span class="text-danger"><?php echo $bgimagemess; ?></span>
        </form>

        <br>

        <form method="post" enctype="multipart/form-data">
            <lable>Video(youtube vidoe code)</lable>
            <input type="text" name="video">
            <input  type="submit" name="VUpload" value="Upload">
            <button type="submit" class="btn" name="Deletevid">Delete</button>
            <span class="text-danger"><?php echo $ppimagemess; ?></span>
        </form>

        <br>

        <form method="post" enctype="multipart/form-data">
            <lable>Add image</lable>
            <input type="file" name="image">
            <input  type="submit" name="pUpload" value="Upload"><br>
            <span class="text-danger"><?php echo $ppimagemess; ?></span>
        </form>


        <br>

        <form method="post" action="/PortfolioV2/View.php?uid=<?php echo $proname;?>" target="_blank">
            <button style="width:100%;" name="veiw" type="submit" class="btn btn-dark bg-dark" >View</button>
        </form>

    </div>
    
<!-- -------------------------------------------------------------------------------------View------------------------------------------------------------------------------------- -->
    <div class="flexbox-main">
        <div class="container">

            <img onerror="this.onerror=null; this.src='../image/grey.jpg'" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($BGimage); ?>" style= "width: 100%; height: 310px">

            <div class="Title">
                <form class="form-horizontal" method="post">
                        <input type="text" name="Title" value="<?php echo $title;?>">
                        <button type="submit" class="btn btn-dark bg-dark" name="update">Update</button>
                </form>
            </div>

            <div class="Text-Block">
                <form class="form-horizontal" method="post">
                        <input style="height: 200px;" type="text" name="Title" value="<?php echo $Texttext;?>">
                        <button type="submit" class="btn btn-dark bg-dark" name="Tupdate">Update</button>
                </form>
            </div>

            <iframe width="100%" height="500" src="<?php echo $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <div class="gallery col ">
                <?php if($prowcount>0):
                for ($i=0; $i<count($Postarray); $i++):?>
                <img style="width:100%;height: 500px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Postarray[$i]['Image']);?>" class="Posts">  <br>
                <div style="background-color: black;text-align: center;">
                <a href="Deleteimage.php?uid=<?php echo $Postarray[$i]['ID'];?>">  (Delete)</a>     
                </div>          
                <?php endfor; endif;?>
            </div>

        </div>
    </div>
</div>


  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php require("../Footer.php");?>