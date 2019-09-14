<?php
session_start();
  include_once ("../../include/application.inc.php");
  include_once ("../../include/config.php");
  require_once ("../../plugins/PHPExcel/PHPExcel.php");
  $config = new Config();
  $db = $config->getConnection();
  
  if ($_POST['type'] == '') {
    $status = 'all';
  } else {
    $status = $_POST['type'];
  }

  $filter = $_GET['period'];
  $period = explode('s/d', $filter);

  if(empty($period)){
    $start = date('d M Y');
    $end = date('d M Y');
    $period[0] = date('y-m-d');
    $period[1] = date('y-m-d');
  } else {
    $start = date('d M Y', strtotime($period[0]));
    $end = date('d M Y', strtotime($period[1]));
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
  }

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
$excel->setActiveSheetIndex(0)->setCellValue('A6', 'No');
$excel->getActiveSheet()->mergeCells('A6:A7');
$excel->setActiveSheetIndex(0)->setCellValue('B6', "Nama Pemohon"); 
$excel->getActiveSheet()->mergeCells('B6:B7');
$excel->setActiveSheetIndex(0)->setCellValue('C6', "Alamat"); 
$excel->getActiveSheet()->mergeCells('C6:C7');
$excel->setActiveSheetIndex(0)->setCellValue('D6', "Lokasi");  
$excel->getActiveSheet()->mergeCells('D6:G6');
$excel->setActiveSheetIndex(0)->setCellValue('H6', "No Sertifikat");
$excel->getActiveSheet()->mergeCells('H6:H7');
$excel->setActiveSheetIndex(0)->setCellValue('I6', "Ket"); 
$excel->getActiveSheet()->mergeCells('I6:I7');
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('D7', 'Pemilik Tanah');
$excel->setActiveSheetIndex(0)->setCellValue('E7', "Alamat Lokasi"); 
$excel->setActiveSheetIndex(0)->setCellValue('F7', "No. PL"); 
$excel->setActiveSheetIndex(0)->setCellValue('G7', "No. Sertifikat");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B6:B7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C6:C7')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('H6:H7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I6:I7')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
try{
$no;
$numrow = 8;
while($row=$stmt->fetch()){    
    $no++;
    $date = date('d/m/Y', strtotime($row['app_date']));
    $pmonth = GetRomawiFromNumber(date('m', strtotime($row['app_date'])));
    $pyear = date('Y', strtotime($row['app_date']));
    $month = GetRomawiFromNumber(date('m', strtotime($row['app_end_date'])));
    $year = date('Y', strtotime($row['app_end_date']));

      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row['app_name'].PHP_EOL.$date.PHP_EOL.str_pad($row['idm_application'], 3, '0', STR_PAD_LEFT)."/PKRK/CKTR/".$pmonth."/".$pyear);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setWrapText(true);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row['app_address']);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setWrapText(true);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

      $excel->getActiveSheet()->setCellValueExplicit('D'.$numrow, $row['app_owner_name'],  PHPExcel_Cell_DataType::TYPE_STRING);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        
      // Khusus untuk no telepon. kita set type kolom nya jadi STRING
      $excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $row['app_owner_address']);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->getAlignment()->setWrapText(true);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row['app_pl_no']);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row['app_certificate_no']);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      if ($row['app_no'] == 0) {
        $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, '');
      } else {
        $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, str_pad($row['app_no'], 3, '0', STR_PAD_LEFT)."/KRK/CKTR/".$month."/".$year);
      }
      
      $excel->getActiveSheet()->getStyle('H'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row['app_status']);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->getAlignment()->setWrapText(true);
        
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
        
      $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        
      $numrow++; // Tambah 1 setiap kali looping
  }
  // Set width kolom
  $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
  $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
  $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
  $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
  $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
  $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
  $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // Set width kolom F
  $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // Set width kolom F
  $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Set width kolom F
} catch (Exception $e) {
  echo $e->getMessage();
}

$objWriter = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="laporan.xlsx"');
for ($i = 0; $i < ob_get_level(); $i++) {
   ob_end_flush();
}
ob_implicit_flush(1);
ob_clean();
$objWriter->save("php://output");