<?php include("UserNavbar.php"); 

$porcheck = $db->query("SELECT * FROM portfolio WHERE UserName='$user'"); 
$rowcount=mysqli_num_rows($porcheck);
if($rowcount>0){
        while ($Irow = mysqli_fetch_array($porcheck)) {
                $Porarray[] = $Irow;
        }
}


if(isset($_POST['Delete'])){
        $em = "";
        $qury="UPDATE portfolio SET Video='$em' WHERE PortfolioID='$proname'";
        $update=mysqli_query($db, $qury);
        header("Refresh:0");
    }
?>


<div style ="text-align: center;">
        <img onerror="this.onerror=null; this.src='../image/default.png'" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($UINFO['ProfilePicture']); ?>" class="HomeAvatar"><br>
        <h class="welcome" ><u>Welcome <?php echo $user;?> </u></h><br><br>
        <p style="font-weight: bold;">YOUR PROJECTS</p>

        <div class="projectbox">

                <a href="NewProjectName.php">   
                        <div class="project" style="height: 130px; background-color: white; text-align: center; padding-top: 25px; color: #3b3b3b;">
                        <p><b>CREATE <br>NEW PORTFOLIO</b></p>
                        </div>   
                </a>                             

                        <?php if($rowcount>0):
                        for ($i=0; $i<count($Porarray); $i++):?>
                        <div class="project">
                                <a href="Edit.php?uid=<?php echo $Porarray[$i]['PortfolioID'];?>">
                                <img class="projectimage" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Porarray[$i]['Image']);?>">
                                </a>
                                <a href="Deletepost.php?uid=<?php echo $Porarray[$i]['ID'];?>">Delete</a>   
                        </div>
                        <?php endfor; endif;?>
                         
        </div>
</div>



<?php require("../Footer.php");?>