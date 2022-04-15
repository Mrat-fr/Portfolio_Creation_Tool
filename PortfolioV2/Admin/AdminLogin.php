<?php include("../Navbar.php"); 
include("../db.php");

if(isset($_POST['login'])){

    $name=$_POST['name'];
    $password=$_POST['pass'];

    $qury="SELECT * FROM admin WHERE Name='$name' AND Password='$password'";
    $reg=mysqli_query($db, $qury);
    $rowcount=mysqli_num_rows($reg);
    if($rowcount>0){
        echo "<h1> You Are Login </h1>";
        session_start();
        $_SESSION['user'] = "admin";
        header('Location: AdminPage.php');
        }else echo "<h3 class='text-center'>Enter Valid Name And Password</h3>";
}
?>

<div class="container">
    <br>
    <div class="col">
        <h2 class="text-center">Admin Login</h2>
    
        <form class="form-horizontal" action="AdminLogin.php" method="post">

            
            <div class="form-group col-sm-10">
                <label class="control-label col">Name:</label>
                <input type="text" class="form-control" name="name" required>
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