<?php
  session_start();
  include_once ("../../include/login.inc.php");
  include_once ("../../include/config.php");
  $config = new Config();
  $db = $config->getConnection();

  $user = new Login($db);
  $stmt=$user->readAll();
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
                <span class="pull-right" style="margin-top: 5px;"> <b>Period :</b></span>
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
                    <input type="hidden" name="var" id="var" value="<?php echo $var;?>">
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
                     <center><span><b style="font-size: 18px;">Keterangan Rencana Kota (KRK)
                    </b></span></center>
                  </td>
                </tr>   
                <tr align="center">
                  <td colspan="6">
                     <center><font style="font-size: 14px;">
                      Periode :
                    </font></center>
                  </td>
                </tr>   
                <tr>
                  <td>&emsp;</td>
                </tr>    
              </table>
            </div>

            <div>
              <table style="font-size: 12px;" class="table table-bordered">
              <tbody>
                <tr style="background-color: #2c3b41; color: #fff;">
                  <td style="text-align: center; vertical-align: middle;" width="10%"> <center><b>Nomor</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="10%"> <center><b>Nama</b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="2%"> <center><b></b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="5%"> <center><b></b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="25%"> <center><b></b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="100%"> <center><b></b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="10%"> <center><b></b></center></td>
                  <td style="text-align: center; vertical-align: middle;" width="10%"> <center><b></b></center></td>
                </tr>
                
                  <!-- <?php 
                  try {
                    $total_debit = 0;
                    $total_credit = 0;
                    while($row=$data->fetch()){
                      $total_debit += $row['debit'];
                      $total_credit += $row['credit'];
                      /*$sql1 = "SELECT td.td_seq_no as no, td.td_th_id as id, tt.trans_type_code, CONCAT(tt.trans_type_code, LPAD(th.th_project_no, 2, '0.00'), LPAD(th.th_investor_no, 2, '0.00')) as code, DATE_FORMAT(th.th_date, '%d/%m/%Y') as juornal_date, td.td_seq_no as no, coa.coa_code,coa.coa_name, td.td_drcr_flag AS drcr, IF(td.td_drcr_flag = 'D', td.td_amt, 0) as debit, IF(td.td_drcr_flag = 'C', td.td_amt, 0) as credit, td.td_desc from ft_trans_header as th
                            JOIN ft_trans_detail td on th.idft_trans_header=td.td_th_id
                            JOIN fm_trans_type as tt on tt.idfm_trans_type = th.th_type_id
                            LEFT JOIN ft_payment_transaction pt ON pt.ft_pt_th_id = th.idft_trans_header
                            LEFT JOIN fm_chart_of_account as coa on coa.idfm_chart_of_account = td.td_coa_id
                            WHERE td.td_th_id = :th_id";
                      $stmt1 = $DB->prepare($sql1);
                      $stmt1->bindValue(':th_id', $row['id']);
                      $stmt1->execute();*/
                      ?>
                          <tr>
                            <td><b><center><?php echo $row['trans_txn_code'].str_pad($row['trans_no'], 6, 0, STR_PAD_LEFT);?></center></b></td>
                            <td><b><?php echo date('d/m/Y', strtotime($row['juornal_date']));?></b></td>
                            <td align="center"> <center><?php echo str_pad($row['no'],2,"0", STR_PAD_LEFT);?></center></td>     
                            <td align="center"> <center><font style="color: #fff;">'</font><?php echo $row['coa_code'];?></center></td>     
                            <td><?php echo $row['coa_name'];?></td>         
                            <td><?php echo $row['td_desc'];?></td>         
                            <td align="right"><?php echo number_format($row['debit'],2,',','.');?></td> 
                            <td align="right"><?php echo number_format($row['credit'],2,',','.');?></td>
                          </tr>
                        
                        <?php
                          
                    }?>
                      <tr>
                        <td colspan="6" align="center">
                          <center><b>Total</b></center>
                        </td>
                        <td align="right">
                          <b><?php echo number_format($total_debit,2,',','.');?></b>
                        </td>
                        <td align="right">
                          <b><?php echo number_format($total_credit,2,',','.');?></b>
                        </td>
                      </tr>
                      <?php
                    
                  } catch (Exception $e) {
                    $e->getMessage();
                  }
                  ?>
                  
                </tr> -->
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
    $(window).scrollTop(0);
    $("#add_user").click(function(){
      $("#konten").load("pages/user/add.php");
    });
    $('#data-user').DataTable();

    function deleteUser(id){
      var id =  id;
      var mode = "delete";
        $.post("pages/user/submit.php", {'id':id, 'mode':mode}, function(data){
              $( "#konten" ).load( "pages/user/user.php", function() {
                    $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 
                  });
                
            },'json');
    }
    function getDetail(id){
      var id =  id;
      $("#konten").load("pages/user/update.php", { 
         'id': id
        });
    }
</script>