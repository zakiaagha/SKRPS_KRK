<?php 
session_start();
include_once ("../../include/application.inc.php");
include_once ("../../include/config.php");

$path_attach = "upload/";
$path_image = "images/";
$config = new Config();
$db = $config->getConnection();

$app = new Application($db);
$id=$_POST['id'];
$app->id = md5($id);
$app->readOne();
$month = GetRomawiFromNumber(date('m', strtotime($app->app_date)));
$year = date('Y', strtotime($app->app_date));

$stmt1=$app->readAttachment();
$stmt2=$app->readImage();
?><!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data KRK
        <small>Detail</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form role="form" method="post" id="update-krk">
            <input type="hidden" id="mode" name="mode" value="update">
            <input type="hidden" id="app_id" name="app_id" value="<?php echo $app->app_id;?>">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Data Permohonan</a></li>
                <li><a href="#tab_2" data-toggle="tab">Persyaratan Teknis</a></li>
                <li><a href="#tab_3" data-toggle="tab">Berkas dan Foto Survei</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table class="table" style="border: none;">
                    <tbody>  
                      <tr>
                        <td style="border: none;" width="15%">Nomor Permohonan</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;"><?php echo $app->app_id.'/KRK/CKTR/'.$month.'/'.$year?></td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="15%">Nama Pemohon</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;"><?php echo strtoupper($app->app_name)?></td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="15%">Alamat</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;"><?php echo $app->app_address?></td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="15%">Atas Nama/Pemilik Tanah</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;"><?php echo $app->app_owner_name?></td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="15%">Alamat Lokasi</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;"><?php echo $app->app_owner_address?></td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="15%">No. Sertifikat</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_certificate_no' name='app_certificate_no' autocomplete='off' value='".$app->app_certificate_no."' required>";
                          } else {                          
                            echo $app->app_certificate_no;
                          }?>
                        </td>
                      </tr>
                      <tr>
                        <td style="border: none;" width="15%">No. PL</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_pl_no' name='app_pl_no' autocomplete='off' value='".$app->app_pl_no."' required>";
                          } else {                          
                            echo $app->app_pl_no;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="15%">Luas Lahan</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_land_area' name='app_land_area' autocomplete='off' value='".$app->app_land_area."' required>";
                          } else {                          
                            echo $app->app_land_area;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="15%">Luas Lahan Permohonan</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_proposed_land_area' name='app_proposed_land_area' autocomplete='off' value='".$app->app_proposed_land_area."' required>";
                          } else {                          
                            echo $app->app_proposed_land_area;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">No. IMB Lama</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_imb_no' name='app_imb_no' autocomplete='off' value='".$app->app_imb_no."' required>";
                          } else {                          
                            echo $app->app_imb_no;
                          }?>
                        </td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <table class="table" style="border: none;">
                    <tbody>  
                      <tr>
                        <td style="border: none;">Peruntukan Lahan Perpres 87/2011</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_allotment_perpres' name='app_allotment_perpres' autocomplete='off' value='".$app->app_allotment_perpres."' required>";
                          } else {                          
                            echo $app->app_allotment_perpres;
                          }?>
                        </td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="45%">Peruntukan Lahan Prov. Kepri 1/2017</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_allotment_prov' name='app_allotment_prov' autocomplete='off' value='".$app->app_allotment_prov."' required>";
                          } else {                          
                            echo $app->app_allotment_prov;
                          }?>
                        </td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="45%">Fungsi Bangunan</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_building_allotment' name='app_building_allotment' autocomplete='off' value='".$app->app_building_allotment."' required>";
                          } else {                          
                            echo $app->app_building_allotment;
                          }?>
                        </td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="45%">Ketinggian Bangunan Maksimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_max_building_height' name='app_max_building_height' autocomplete='off' value='".$app->app_max_building_height."' required>";
                          } else {                          
                            echo $app->app_max_building_height;
                          }?>
                        </td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="45%">Jumlah lantai/lapis bangunan gedung dibawah permukaan tanah dan KTB</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_no_of_floors' name='app_no_of_floors' autocomplete='off' value='".$app->app_no_of_floors."' required>";
                          } else {                          
                            echo $app->app_no_of_floors;
                          }?>
                        </td>
                      </tr>  
                      <tr>
                        <td style="border: none;" width="45%">GSB (Garis Sempadan Bangunan)</td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">&emsp;a. GSB Depan Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_gsb_front' name='app_min_gsb_front' autocomplete='off' value='".$app->app_min_gsb_front."' required>";
                          } else {                          
                            echo $app->app_min_gsb_front;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">&emsp;b. GSB Samping Kanan Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_gsb_right_side' name='app_min_gsb_right_side' autocomplete='off' value='".$app->app_min_gsb_right_side."' required>";
                          } else {                          
                            echo $app->app_min_gsb_right_side;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">&emsp;c. GSB Samping Kiri Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_gsb_left_side' name='app_min_gsb_left_side' autocomplete='off' value='".$app->app_min_gsb_left_side."' required>";
                          } else {                          
                            echo $app->app_min_gsb_left_side;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">&emsp;d. GSB Belakang Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_gsb_back' name='app_min_gsb_back' autocomplete='off' value='".$app->app_min_gsb_back."' required>";
                          } else {                          
                            echo $app->app_min_gsb_back;
                          }?>
                        </td>
                      </tr>
                      <tr>
                        <td style="border: none;" width="45%">GSP (Garis Sempadan Pagar) Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_gsp' name='app_min_gsp' autocomplete='off' value='".$app->app_min_gsp."' required>";
                          } else {                          
                            echo $app->app_min_gsp;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">KDB (Koefisien Dasar Bangunan) Maksimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_max_kdb' name='app_max_kdb' autocomplete='off' value='".$app->app_max_kdb."' required>";
                          } else {                          
                            echo $app->app_max_kdb;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">KLB (Koefisien Lantai Bangunan) Maksimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_max_klb' name='app_max_klb' autocomplete='off' value='".$app->app_max_klb."' required>";
                          } else {                          
                            echo $app->app_max_klb;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">KDH (Koefisien Daerah Hijau) Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_min_kdh' name='app_min_kdh' autocomplete='off' value='".$app->app_min_kdh."' required>";
                          } else {                          
                            echo $app->app_min_kdh;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">KTB (Koefisien Tapak Basement) Maksimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_max_ktb' name='app_max_ktb' autocomplete='off' value='".$app->app_max_ktb."' required>";
                          } else {                          
                            echo $app->app_max_ktb;
                          }?>
                        </td>
                      </tr> 
                      <tr>
                        <td style="border: none;" width="45%">Lebar Akses Jalan Masuk/Keluar Minimum</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">
                          <?php 
                          if ($_SESSION['role_id'] == 1) {
                            echo "<input type='text' class='form-control' id='app_row' name='app_row' autocomplete='off' value='".$app->app_row."' required>";
                          } else {                          
                            echo $app->app_row;
                          }?>
                        </td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">

                  <div class="row flex-row">
                    <div class="col-md-4">          
                      <h4><font style="font-size: 17px;"><b>&nbsp;&nbsp;BERKAS PERSYARATAN</b></font></h4>
                      <table class="table" style="border: none;">
                        <?php
                        ?>
                        <tbody>  
                          <?php 
                          while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                            <td style="border: none;"><?php echo $row['app_attach_name']?></td>
                            <td style="border: none;" width="45%">
                              <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="lihatPDF('<?php echo $row['app_attach_name'];?>')">Lihat</a>
                            </td>
                          </tr>  
                        <?php } ?>
                        </tbody>
                      </table> 
                    </div>
                    <div class="col-md-8">                      
                      <h4><font style="font-size: 17px;"><b>FOTO SURVEI</b></font></h4>
                      <div id="foto_lokasi" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <?php
                          $no=0;
                          while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                            if ($row['app_image_seq'] == 1) {
                              $active = 'active';
                            } else {
                              $active = '';
                            }
                            echo "<div class='item ".$active."'>";
                            echo "<img src='images/".$row['app_image_name']."' alt='First slide'>";
                            echo "</div>";
                            $no++;
                          } ?>
                          <a class="left carousel-control" href="#foto_lokasi" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                          </a>
                          <a class="right carousel-control" href="#foto_lokasi" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                          </a>
                        </div>

                      </div>
                    </div>
                  </div>
                
                  
                </div>
                <!-- /.tab-pane -->
                <?php 
                if ($_SESSION['role_id'] == 1) {?>
                  <br>
                  <button type="submit" class="btn btn-primary" style="width:90px;">Simpan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Batal</button>
                  <br/><br/>
                <?php } ?>              
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </form>
        </div>
      </div>
        <!-- /.col -->
    </section>

    <div class="modal" id="pdf">
      <form role="form" id="pdf-method" method="post">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lihat Berkas</h4>
              </div>
              <div class="modal-body">
              <iframe src="" id='pdf_view' name="pdf_view" width="100%" height="400px" frameborder="0" allowtransparency="true"></iframe>   <!-- 
                  <embed src="upload/KTP.pdf" id='pdf_view' name="pdf_view" frameborder="0" width="100%" height="400px"> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Tutup</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
    <!-- /.modal-dialog -->
    </div>

<script type="text/javascript">
  $(document).ready(function() {
      $('#update-krk').submit(function(e){
          e.preventDefault();
          var inputs = $(this).serialize();
            $.post("pages/krk/submit.php", inputs, function(data){
              $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 
              $("#konten").load("pages/krk/krk.php");
            },'json');
          });
      });
  function lihatPDF(name){
      var name = name;
      $('#pdf').modal('show');
      $("#pdf_view").attr("src","upload/"+name);
    }
</script>

