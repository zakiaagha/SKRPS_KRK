<?php
include_once 'admin/include/config.php';

$config = new Config();
$db = $config->getConnection();

$hal = empty($_GET['hal']) ? "": $_GET['hal'];
include 'header.php';
if ($hal == 'cara_pengajuan') {
  include 'cara_pengajuan.php';
} elseif ($hal == 'permohonan_baru') {
  include 'permohonan_baru.php';
} elseif ($hal == 'cek_status') {
  include 'cek_status.php';
} elseif ($hal == 'draft_krk') {
  include 'draft.php';
} elseif ($hal == 'draft_krk') {
  include 'cetak_draft.php';
} elseif ($hal == 'ubah') {
  include 'permohonan_ubah.php';
} else {
  include 'intro.php';
  include 'main.php';
}

include 'footer.php';
?>