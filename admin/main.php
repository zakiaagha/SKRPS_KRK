<?php
session_start();
$idletime=60;//after 60 seconds the user gets logged out
/*if (time()-$_SESSION['timestamp']>$idletime){
    session_destroy();
    session_unset();
}else{
    $_SESSION['timestamp']=time();
}*/

$home = "./";
if (!isset($_SESSION["user_name"])) {
    // not logged in send to login page
    header('location:login.php');
} else {	
	include "include/head.php";
	include "include/header.php";
	include "include/sidebar.php";
	include "include/content.php";
	include 'include/footer.php';
	include 'include/script.php';
}

?>
