<?php
session_start();
include_once ("../../include/application.inc.php");
include_once ("../../include/config.php");
$config = new Config();
$db = $config->getConnection();

$app = new Application($db);

$app_id = $_POST['app_id'];
$mode = $_POST['mode'];
$app_komentar = $_POST['app_komentar'];
$status = $_POST['type'];

if ($mode == 'status') {
	$app->app_status=$status;
	$app->app_comment=$app_komentar;
	$app->app_id=$app_id;
	$app->uid=$_SESSION['user_name'];
	$app->datenow=date("Y-m-d H:i:s");

	if($app->updateStatus()){
		$data = array(
	                        "msg"     => 'Permohonan KRK ditunda',
	                        "type"  => 'warning'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Penundaan Permohonan KRK gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);
}
?>