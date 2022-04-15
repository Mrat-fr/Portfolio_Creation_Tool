<?php include("AdminNavbar.php"); 
$user = $_GET['uid'];
$usercheck = $db->query("SELECT * FROM users WHERE UserName='$user'"); 
$UINFO=mysqli_fetch_array($usercheck);
$Deactivated = $UINFO['Deactivated'];
$porcheck = $db->query("SELECT * FROM portfolio WHERE UserName='$user'"); 
$rowcount=mysqli_num_rows($porcheck);
if($rowcount>0){
    while ($Irow = mysqli_fetch_array($porcheck)) {
        $Porarray[] = $Irow;
    }
}

if(isset($_POST["Deactivate"])){ 
    $check = $db->query("UPDATE users SET Deactivated = 'Yes' WHERE UserName='$user'");
    header("Refresh:0");
  }
if(isset($_POST["Activate"])){ 
    $check = $db->query("UPDATE users SET Deactivated = 'No' WHERE UserName='$user'");
    header("Refresh:0");
}

?>


<div style ="text-align: center;">
        <img onerror="this.onerror=null; this.src='../image/default.png'" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($UINFO['ProfilePicture']); ?>" class="HomeAvatar"><br>
        <h class="welcome" ><u><?php echo $user;?> </u></h>
        <br>

        <div style="margin-left: 275px;">
            <?php if($Deactivated == "No"):?>
            <form class="form-horizontal" method="post">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger" name="Deactivate">Deactivate User</button>
            </div>
            </form>
            <?php else: ?>
            <form class="form-horizontal" method="post">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="Activate">Activate User</button>
            </div>
            </form>

            <?php endif; ?>
        </div>

        <p style="font-weight: bold;">USER PROJECTS</p>

        <div class="projectbox">
            <?php if($rowcount>0):
            for ($i=0; $i<count($Porarray); $i++):?>
            <div style="height: 130px;" class="project">
                    <a href="/PortfolioV2/View.php?uid=<?php echo $Porarray[$i]['PortfolioID'];?>">
                    <img class="projectimage" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Porarray[$i]['Image']);?>">
                    </a>
            </div>
            <?php endfor; endif;?>  
        </div>
</div>



<?php require("../Footer.php");?>