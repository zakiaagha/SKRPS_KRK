<?php
  session_start();
  include_once ("../../include/application.inc.php");
  include_once ("../../include/config.php");
  $config = new Config();
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
  }
  ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">        
        <div class="col-xs-12"><font style="margin-bottom: 110px;" />
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-header bg-info" align="center">
              <div style="margin-top: 10px; margin-bottom: 10px;">
                <div class="col-xs-1">
                <span class="pull-right" style="margin-top: 5px;"> <b>Kategori:</b></span>
                </div>
                <div class="col-xs-2" align="left">
                  <select class="form-control" id="type" name="type">
                    <option value="all">All</option>
                    <option value="disetujui" 
                    <?php if ( $status == 'disetujui') {
                      echo 'selected';
                    } ?>
                    >Disetujui</option>
                    <option value="ditunda"
                    <?php if ( $status == 'ditunda') {
                      echo 'selected';
                    } ?>
                    >Ditunda</option>
                    <option value="ditolak"
                    <?php if ( $status == 'ditolak') {
                      echo 'selected';
                    } ?>
                    >Ditolak</option>
                    <option value="batal"
                    <?php if ( $status == 'batal') {
                      echo 'selected';
                    } ?>
                    >Batal</option>                    
                  </select>
                </div>
                <div class="col-xs-1">
                <span class="pull-right" style="margin-top: 5px;"> <b>Period:</b></span>
                </div>
                <div class="col-xs-3" align="left">
                  <div class="input-group" style="margin-bottom: 10px;">
                    <button type="button" class="btn btn-default" id="period">
                      <span>
                        03/01/2018 - 03/01/2018 
                      </span>&emsp;
                      <i class="fa fa-caret-down"></i>
                    </button>
                  </div>
                </div>
                <div class="col-xs-1">
                    <button type="button" class="btn btn-primary" id="filter">Submit</button>
                </div>
                <div class="col-xs-3 pull-right">
                  <div class="btn-group">
                      <button type="button" class="btn btn-primary" id="print_journal"><i class="fa fa-print"></i>&emsp;Print&nbsp;&nbsp;</button>
                  </div>                  
                  <div class="btn-group pull-right">
                      <button type="button" class="btn btn-primary" id="printExcel"><i class="fa fa-file-excel-o"></i>&emsp;Export Excel</button>
                  </div>
                </div>
              </div>               
            <!-- /.box-body -->
            </div>
            <div class="box-body" id="data">
              <div align="center"><br>
              <table style="border: none !important;">
                <tr align="center">
                  <td colspan="6">
                     <center><font style="font-size: 18px;">Laporan</font></center>
                  </td>
                </tr>    
                <tr align="center">
                  <td colspan="6">
                     <center><font style="font-size: 18px;">Data Permohonan Izin</font></center>
                  </td>
                </tr> 
                <tr align="center">
                  <td colspan="6">
                     <center><span><font style="font-size: 18px;">Keterangan Rencana Kota (KRK)
                    </font></span></center>
                  </td>
                </tr>   
                <tr align="center">
                  <td colspan="6">
                     <center><font style="font-size: 14px;">
                      Periode : 
                      <?php 
                    if (!empty($period[0]) && !empty($period[1])){

                      echo $start.' s/d '.$end;
                    } else {
                      //echo date('d/m/Y').' s/d '.date('d/m/Y');
                    }?>
                    </font></center>
                  </td>
                </tr>   
                <tr>
                  <td>&emsp;</td>
                </tr>    
              </table>
            </div>

            <div>
              <table id="report-data" style="font-size: 12px;" class="table table-bordered">
              <tbody>
                <tr style="background-color: #2c3b41; color: #fff;">
                  <td style="text-align: center; vertical-align: middle;" width="5%" rowspan="2"> <center><b>No</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" rowspan="2"> <center><b>Nama Pemohon</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" rowspan="2"> <center><b>Alamat</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" colspan="4"> <center><b>Lokasi</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" rowspan="2"> <center><b>No Sertifikat</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" rowspan="2"> <center><b>Ket</b></center></td>
                </tr>
                <tr style="background-color: #2c3b41; color: #fff;">
                  <td style="text-align: center; vertical-align: middle;"> <center><b>Pemilik Tanah</b></center></td>
                  <td style="text-align: center; vertical-align: middle;"> <center><b>Alamat Lokasi</b></center></td>
                  <td style="text-align: center; vertical-align: middle;"> <center><b>No. PL</b></center></td>
                  <td style="text-align: center; vertical-align: middle;"> <center><b>No. Setifikat</b></center></td>
                </tr>
                <?php
                $no;
                  while($row=$stmt->fetch()){
                    $no++;
                    $pmonth = GetRomawiFromNumber(date('m', strtotime($row['app_date'])));
                    $pyear = date('Y', strtotime($row['app_date']));
                    $month = GetRomawiFromNumber(date('m', strtotime($row['app_approve_date'])));
                    $year = date('Y', strtotime($row['app_approve_date']));
                ?>
                    <tr>
                            <td><b><center><?php echo $no;?></center></b></td>
                            <td><?php echo $row['app_name'].'<br>'.$row['app_date'].'<br>'.str_pad($row['idm_application'], 3, '0', STR_PAD_LEFT)."/KRK/CKTR/".$pmonth."/".$pyear;?></td>
                            <td align="center"> <center><?php echo $row['app_address'];?></center></td>     
                            <td align="center"> <center><?php echo $row['app_owner_name'];?></center></td>     
                            <td><?php echo $row['app_owner_address'];?></td>         
                            <td><?php echo $row['app_pl_no'];?></td>         
                            <td><?php echo $row['app_certificate_no'];?></td>   
                            <td><?php echo str_pad($row['app_no'], 3, '0', STR_PAD_LEFT)."/KRK/CKTR/".$month."/".$year;?></td>         
                            <td><?php echo $row['app_comment'];?></td>         
                          </tr>
                <?php
                  }?>
              </tbody>
            </table>

            </div>
            </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </section> 

<script>
  $(document).ready(function(){
    var start = '<?php echo $start;?>';
    var end = '<?php echo $end;?>';

    $("#filter").click(function(e){
      e.preventDefault();
      var start = $('#period').data('daterangepicker').startDate.format('YY-MM-DD');
      var end =   $('#period').data('daterangepicker').endDate.format('YY-MM-DD');
      var type = $('#type').val();
      var period = new Array();
      period[0] = start;
      period[1] = end;
      $("#konten").load("pages/report/report.php", {
        "period": period,
        "type": type
      });
    });

    $(window).scrollTop(0);

    $('#period').daterangepicker(
      { startDate: start,
        endDate: end,
        ranges   : {
          'Today'       : [moment(), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')]
        },
        locale: {
          format: 'DD/MM/YYYY'
        }
      },
      function (start, end) {
        $('#period span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
      }
    );

    $('#period span').html(moment(start, "DD/MM/YYYY").format('DD/MM/YYYY') + '  -  ' + moment(end, "DD/MM/YYYY").format('DD/MM/YYYY'));
    
    $("#printExcel").click(function(e){
      e.preventDefault();
      var start = '<?php echo $period[0];?>';
      var end = '<?php echo $period[1];?>';
      var period = start+'s/d'+end;
      var type = '<?php echo $status;?>';
      alert(type);
      window.open("pages/report/print_excel.php?period="+period+"&type="+type, '_blank');
    });
   
  });

  $('#report-data').DataTable();
    
</script>