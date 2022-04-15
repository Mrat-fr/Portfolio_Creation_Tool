<?php include("UserNavbar.php"); 

if(isset($_POST['update'])){
    $num = uniqid();
    $proID = $user.$num;
    $image = '../image/projectdefault.jpg'; 
    $PP = addslashes(file_get_contents($image));
    $name=$_POST['name'];
    $qury="INSERT INTO portfolio (PortfolioID,UserName,Title,Image) values ('$proID','$user','$name','$PP')";
    $reg=mysqli_query($db, $qury);
    header('Location: NewProjectImage.php?uid='.$proID);
}
?>

<div class="container">
    <h2 class="text-center">Project Infomation</h2>
    <br>
    <div class="col">

        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2">Project Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            

            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-dark bg-dark" name="update">NEXT</button>
            </div>
            </div>
        </form>
    </div>
</div>  

  
  
<br><br><br><br><br><br><br><br>
<?php require("../Footer.php");?>