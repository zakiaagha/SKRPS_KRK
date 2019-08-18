<?php
include_once 'includes/head.php';
include_once 'includes/header.php';
include_once 'includes/sidebar.php';
$menu = $_GET['m'];
if ($menu == 'krk_usr') {
  include "pages/user/list.php";
} elseif ($menu == 'krk_data') {
  include "pages/data/list.php";
} else {
  include "home.php";
}
include_once 'includes/footer.php';
include_once 'includes/script.php';
?>

