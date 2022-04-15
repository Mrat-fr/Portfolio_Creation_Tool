<?php require("AdminNavbar.php");

$usercheck = $db->query("SELECT * FROM users"); 
while ($Irow = mysqli_fetch_array($usercheck)) {
    $UserInfro[] = $Irow;
  }
?>

<div class="container bgColor">
  <main role="main" class="pb-3">
  <h2 style="text-align: center">ADMIN</h2>

  <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <td style="text-align: center;">Users</td>
                    </thead>

                    <?php for ($i=0; $i<count($UserInfro); $i++):?>
                        <tr style="text-align: center;">
                        <td>
                        <a target="_blank" href="AdminView.php?uid=<?php echo $UserInfro[$i]['UserName'];?>" >
                            <img onerror="this.onerror=null; this.src='../image/default.png'" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($UserInfro[$i]['ProfilePicture']); ?>" class="HomeAvatar"><br>
                        </a>
                            <h><?php echo $UserInfro[$i]['UserName'];?></h> 
                        </td>
                        </tr>        
                    <?php endfor;?>  
                                           
                    </tr>
                </table>    
            </div>
        </div>







  </main>
</div >
<br><br><br><br><br>

<?php require("../Footer.php");?>