<?php
include_once 'includes/user.inc.php';
$user = new User($db);

$user->user_name=$_POST['user_name'];
$user->user_full_name=$_POST['user_full_name'];
$user->user_nip=$_POST['user_nip'];
$user->user_email=$_POST['user_email'];
$user->user_password=$_POST['user_password'];
$user->user_address=$_POST['user_address'];
$user->user_telpon=$_POST['user_telpon'];
$user->user_role=$_POST['user_role'];
$user->insert();
?>