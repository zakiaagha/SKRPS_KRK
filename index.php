<?php
include_once 'admin/includes/config.php';

$config = new Config();
$db = $config->getConnection();

$hal = empty($_GET['hal']) ? "": $_GET['hal'];
if ($hal == 'cara_pengajuan') {
  include 'cara_pengajuan.php';
} elseif ($hal == 'permohonan_baru') {
  include 'permohonan_baru.php';
} elseif ($hal == 'cek_status') {
  include 'cek_status.php';
} elseif ($hal == 'cetak_draft') {
  include 'cetak_draft.php';
} else {
  include 'header.php';
  include 'intro.php';
  include 'main.php';
  include 'footer.php';
}

?>