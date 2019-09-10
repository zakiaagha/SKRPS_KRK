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
	                        "msg"     => 'Verifikasi berhasil',
	                        "type"  => 'warning'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Verifikasi gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);
} elseif ($mode == 'update') {
	$app->app_id=$app_id;
	$app->app_certificate_no=$_POST['app_certificate_no'];
	$app->app_pl_no=$_POST['app_pl_no'];
	$app->app_imb_no=$_POST['app_imb_no'];
	$app->app_allotment_perpres=$_POST['app_allotment_perpres'];
	$app->app_allotment_prov=$_POST['app_allotment_prov'];
	$app->app_building_allotment=$_POST['app_building_allotment'];
	$app->app_max_building_height=$_POST['app_max_building_height'];
	$app->app_no_of_floors=$_POST['app_no_of_floors'];
	$app->app_min_gsb_front=$_POST['app_min_gsb_front'];
	$app->app_min_gsb_right_side=$_POST['app_min_gsb_right_side'];
	$app->app_min_gsb_left_side=$_POST['app_min_gsb_left_side'];
	$app->app_min_gsb_back=$_POST['app_min_gsb_back'];
	$app->app_min_gsp=$_POST['app_min_gsp'];
	$app->app_max_kdb=$_POST['app_max_kdb'];
	$app->app_max_klb=$_POST['app_max_klb'];
	$app->app_min_kdh=$_POST['app_min_kdh'];
	$app->app_max_ktb=$_POST['app_max_ktb'];
	$app->app_land_area=$_POST['app_land_area'];
	$app->app_proposed_land_area=$_POST['app_proposed_land_area'];
	$app->app_row=$_POST['app_row'];
	$app->uid=$_SESSION['user_name'];
	$app->datenow=date("Y-m-d H:i:s");

	if($app->update()){
		$data = array(
	                        "msg"     => 'Update data berhasil',
	                        "type"  => 'warning'
	                    );
	} else {
	    $data = array(
	                        "msg"     => 'Update data gagal',
	                        "type"  => 'danger'
	                    );
	}
	echo json_encode($data);
	# code...
} elseif ($mode == 'unggah') {
	$app_id = $_POST['app_id_unggah'];
	$seq=0;
	foreach ($_FILES['files']['name'] as $f => $name) {
		$seq++   ;	     
		$name_file = $app_id."_".$name;
		$app->app_id=$app_id;
		$app->app_file_temp = $_FILES['files']['tmp_name'][$f];
		$app->app_file_name = $app->app_id."_".$_FILES['files']['name'][$f];
		$app->app_file_type = $_FILES['files']['type'][$f];
		$app->app_file_size = $_FILES['files']['size'][$f];
		$app->app_seq_file = $seq;
		$app->uid=$_SESSION['user_name'];
		$app->datenow=date("Y-m-d H:i:s");

		if($app->insertImage() && move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name_file)){
			$data = array(
		                        "msg"     => 'unggah berhasil',
		                        "type"  => 'warning'
		                    );
		} else {
		    $data = array(
		                        "msg"     => 'unggah gagal',
		                        "type"  => 'danger'
		                    );
		}
		echo json_encode($data);
	}
}
?>