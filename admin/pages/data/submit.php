<?php
session_start();
include_once ("../../include/application.inc.php");
include_once ("../../include/config.php");
$config = new Config();
$db = $config->getConnection();

$app = new Application($db);

$app_id = $_POST['app_id'];
$mode = isset($_POST['mode']) ? $_POST['mode'] : $_POST['mode_unggah'];
$app_komentar = $_POST['app_komentar'];
$status = $_POST['type'];
$path = "../../upload/"; 

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
} elseif ($mode == 'unggah') {
	$app_id = $_POST['app_id_unggah'];
	foreach ($_FILES['files']['name'] as $f => $name) { 
		/*
	  	$seq++   ;
		if ($_FILES['files']['error'][$f] == 4) {
			continue; // Skip 
		}	       
		if ($_FILES['files']['error'][$f] == 0) {	           
			if ($_FILES['files']['size'][$f] > $max_file_size) {
		    	$message[] = "$name is too large!.";
		        continue;
			} elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $format_file) ) {
				$message[] = "$name is not a valid format";
				continue; 
			} else {
		  		if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
		    	$count++;
			}
		}*/

		$app->uid=$_SESSION['user_name'];
		$app->datenow=date("Y-m-d H:i:s");
		$app->app_file_temp = $_FILES['files']['tmp_name'][$f];
		$app->app_file_name = $_FILES['files']['name'][$f];
		$app->app_file_type = $_FILES['files']['type'][$f];
		$app->app_file_size = $_FILES['files']['size'][$f];
		$app->app_seq_file = $seq;
		$data = array(
	                        "msg"     => $_FILES['files']['name'][$f],
	                        "type"  => 'warning'
	                    );
	}	
	

	echo json_encode($data);
}
?>