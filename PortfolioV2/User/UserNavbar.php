<!doctype html>
<html lang="en">
  <head>
    <title>portfolio</title>
    <link rel="stylesheet" href="\portfolioV2\Style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  </head>

<body class="bgColor">

<?php 
include("../db.php");
session_start(); 
$user = $_SESSION["UserName"]; 
//user info
$usercheck = $db->query("SELECT * FROM users WHERE UserName='$user'"); 
$UINFO=mysqli_fetch_array($usercheck);
$pp = $UINFO['ProfilePicture'];

?>

	<header>

        <nav class="navbar  navbar-expand-sm navbar-toggleable-sm navbar-dark bg-dark border-bottom box-shadow mb-3">

            <a class="nav-link text-dark" href="UserHome.php">
                <img alt="User Icon" src="../image/logo1.png" width="140" height="24">
            </a>
            
            <a class="nav-link text-light" href="Update.php">Update Infomation</a>

            <a class="nav-link text-light" href="Logout.php">Logout</a>     

 
        </nav>