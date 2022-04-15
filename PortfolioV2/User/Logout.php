<?php 
session_start();
session_destroy();
header('Location: \PortfolioV2\index.php');
exit;

?>