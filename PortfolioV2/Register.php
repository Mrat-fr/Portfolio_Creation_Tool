<?php include("Navbar.php"); 
include("db.php");

$dbemail=$dbuname="";

if(isset($_POST['register'])){
    
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $uname=$_POST['uname'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $image = '../PortfolioV2/image/default.png'; 
    $PP = addslashes(file_get_contents($image));
    $Deactivated = "No";

    $qury="SELECT * FROM users WHERE Email='$email'";
    $check=mysqli_query($db, $qury);
    $rowcount=mysqli_num_rows($check);
    if($rowcount>0){
    $rows=mysqli_fetch_array($check);
    $dbemail=$rows['Email'];
    }

    $qury="SELECT * FROM users WHERE UserName='$uname'";
    $check=mysqli_query($db, $qury);
    $rowcount=mysqli_num_rows($check);
    if($rowcount>0){
    $rows=mysqli_fetch_array($check);
    $dbuname=$rows['UserName'];
    }
    
    if($dbemail==$email){echo"<h3 class='text-center'>This Email $email Already Registerd</h3>";}
    else {
        if($dbuname==$uname){echo"<h3 class='text-center'>This User Name $uname Already Registerd</h3>";}
        else{
            $qury="INSERT INTO users (FirstName,LastName,UserName,ProfilePicture,Email,Password,Deactivated) values ('$fname','$lname','$uname','$PP','$email','$pass','$Deactivated')";
            $reg=mysqli_query($db, $qury);
            if($reg) echo "<h3 class='text-center'>You Are Registered</h3>";
            else{
                echo "<h3 class='text-center'>ERROR</h3>";
            }
        }
    }
}

?>

<div class="container">
    <br>
    <div class="col">
        <h2 class="text-center">Register </h2>
    
        <form class="form-horizontal" action="Register.php" method="post">

            
            <div class="form-group col-sm-10">
                <label class="control-label col">First Name:</label>
                <input type="text" class="form-control" name="fname" required>
            </div>

            <div class="form-group col-sm-10">
                <label class="control-label col">Last Name:</label>
                <input type="text" class="form-control" name="lname" required>
            </div>

            <div class="form-group col-sm-10">
                <label class="control-label col">User Name:</label>
                <input type="text" class="form-control" name="uname" required>
            </div>

            <div class="form-group col-sm-10">
                <label class="control-label col">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group col-sm-10">          
                <label class="control-label col">Password:</label>
                <input type="password" class="form-control" name="pass" required>
            </div>

            <div class="form-group col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="register">Register</button>
            </div>

        </form>
    </div>
</div>  
<br><br><br><br><br><br><br>
<?php require("Footer.php");?>