<?php
session_start();
include_once ("../../include/user.inc.php");
include_once ("../../include/config.php");
$config = new Config();
$db = $config->getConnection();

$user = new User($db);

$mode = $_POST['mode'];
if ($mode == 'create') {
	$user->user_name=$_POST['user_name'];
	$user->user_full_name=$_POST['user_full_name'];
	$user->user_nip=$_POST['user_nip'];
	$user->user_email=$_POST['user_email'];
	$user->user_password=md5($_POST['user_password']);
	$user->user_address=$_POST['user_address'];
	$user->user_telpon=$_POST['user_telpon'];
	$user->user_role=$_POST['user_role'];
	$user->uid=$_SESSION['user_name'];
	$user->datenow=date("Y-m-d H:i:s");

	if($user->insert()){
		$data = array(
	                        "msg"     => 'Penambahan pengguna berhasil',
	                        "type"  => 'success'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Penambahan pengguna gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);
} elseif ($mode == 'update') {
	$user->id = $_POST['uid'];
    $user->user_name=$_POST['user_name'];
    $user->user_full_name=$_POST['user_full_name'];
    $user->user_nip=$_POST['user_nip'];
    $user->user_email=$_POST['user_email'];
    $user->user_password=md5($_POST['user_password']);
    $user->user_address=$_POST['user_address'];
    $user->user_telpon=$_POST['user_telpon'];
    $user->user_role=$_POST['user_role'];
    $user->uid=$_SESSION['user_name'];
    $user->datenow=date("Y-m-d H:i:s");

    if($user->update()){
		$data = array(
	                        "msg"     => 'Perubahan pengguna berhasil',
	                        "type"  => 'success'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Perubahan pengguna gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);   
} elseif ($mode == 'delete') {
	$uid = $_POST['id'];
	$user->id=$uid;
	if($user->deleteOne()){
		$data = array(
	                        "msg"     => 'Hapus pengguna berhasil',
	                        "type"  => 'success'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Hapus pengguna gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);
}

?>