<?php include("../Navbar.php"); 
include("../db.php");

if(isset($_POST['login'])){

    $uname=$_POST['uname'];
    $password=$_POST['pass'];

    $qury=$db->query("SELECT * FROM users WHERE UserName='$uname' AND Password='$password'");
    $rowcount=mysqli_num_rows($qury);
    $rows=mysqli_fetch_array($qury);
    if($rowcount>0){
        if($rows['Deactivated'] == "Yes"){
            echo "<h3 class='text-center'>Your accont has been deativated</h3>";
        }
        else{
        echo "<h1> You Are Login </h1>";
        session_start();
        $_SESSION['UserName'] = $uname;
        header('Location: UserHome.php');
        }
    }
    else echo "<h3 class='text-center'>Enter Valid User Name And Password</h3>";
}
?>

<div class="container">
    <br>
    <div class="col">
        <h2 class="text-center">Login</h2>
    
        <form class="form-horizontal" action="UserLogin.php" method="post">

            
            <div class="form-group col-sm-10">
                <label class="control-label col">User Name:</label>
                <input type="text" class="form-control" name="uname" required>
            </div>

            <div class="form-group col-sm-10">          
                <label class="control-label col">Password:</label>
                <input type="password" class="form-control" name="pass" required>
            </div>

            <div class="form-group col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>

        </form>
    </div>
</div>  

  
  

<?php require("../Footer.php");?>