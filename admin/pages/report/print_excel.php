<?php
session_start();
  include_once ("../../include/application.inc.php");
  include_once ("../../include/config.php");
  require_once ("../../plugins/PHPExcel/PHPExcel.php");
  /*$config = new Config();
  $db = $config->getConnection();
  
  $status = $_POST['type'];
  $period = $_POST['period'];

  if(empty($period)){
    $start = date('d/m/Y');
    $end = date('d/m/Y');
    $period[0] = date('y-m-d');
    $period[1] = date('y-m-d');
  } else {
    $start = date('d/m/Y', strtotime($period[0]));
    $end = date('d/m/Y', strtotime($period[1]));
  }


  try {
    if ($status == 'all') {
      $sql = "SELECT * FROM krk_applications WHERE app_date BETWEEN :start_date AND :end_date";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':start_date', $period[0]);
      $stmt->bindValue(':end_date', $period[1]);
    } else {
      $sql = "SELECT * FROM krk_applications WHERE app_status=:status AND app_date BETWEEN :start_date AND :end_date ";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':status', $status);
      $stmt->bindValue(':start_date', $period[0]);
      $stmt->bindValue(':end_date', $period[1]);
    }
    $stmt->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
  }*/

$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Siswa")
             ->setSubject("Siswa")
             ->setDescription("Laporan Semua Data Siswa")
             ->setKeywords("Data Siswa");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan'); 
$excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
$excel->setActiveSheetIndex(0)->setCellValue('A2', 'Data Permohonan Izin'); 
$excel->getActiveSheet()->mergeCells('A2:I2');
$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); 
$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->setActiveSheetIndex(0)->setCellValue('A3', "Keterangan Rencana Kota (KRK)"); 
$excel->getActiveSheet()->mergeCells('A3:I3');
$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); 
$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(13); 
$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->setActiveSheetIndex(0)->setCellValue('A4', $start.' s/d '.$end); 
$excel->getActiveSheet()->mergeCells('A4:I4');
$excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE); 
$excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(13); 
$excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A6', "No");
$excel->setActiveSheetIndex(0)->setCellValue('B6', "Nama Pemohon"); 
$excel->setActiveSheetIndex(0)->setCellValue('C6', "Alamat"); 
$excel->setActiveSheetIndex(0)->setCellValue('D6', "Lokasi");  
$excel->getActiveSheet()->mergeCells('D6:G6');
$excel->setActiveSheetIndex(0)->setCellValue('H6', "No Sertifikat");
$excel->setActiveSheetIndex(0)->setCellValue('I6', "Ket"); 

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);


$objWriter = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="laporan.xlsx"');
for ($i = 0; $i < ob_get_level(); $i++) {
   ob_end_flush();
}
ob_implicit_flush(1);
ob_clean();
$objWriter->save("php://output");