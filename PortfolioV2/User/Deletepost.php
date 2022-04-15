<?php
include("../db.php");
$id = $_GET["uid"];
$insert = $db->query("DELETE FROM portfolio WHERE ID = '$id'"); 
header('Location: UserHome.php');
?>