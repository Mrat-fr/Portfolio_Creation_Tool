<?php
include("../db.php");
$id = $_GET["uid"];
$que = $db->query("SELECT * FROM portfolioimages WHERE ID='$id'"); 
$home=mysqli_fetch_array($que);
$prot = $home['PortfolioID'];;
$insert = $db->query("DELETE FROM portfolioimages WHERE ID = '$id'"); 
header('Location: Edit.php?uid='.$prot);

?>