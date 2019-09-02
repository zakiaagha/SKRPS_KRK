<?php
  session_start();
  include_once ("../../include/application.inc.php");
  include_once ("../../include/config.php");
  $config = new Config();
  $db = $config->getConnection();
  
  $app = new Application($db);
  $stmt=$app->readAll();
  ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data KRK
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Permohonan KRK</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-xs-12 col-lg-12 table-responsive">
                <table id="data-krk" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="3%">No</th>
                  <th>Nomor</th>
                  <th>Tanggal</th>
                  <th>Nama Pemohon</th>
                  <th>Lokasi</th>
                  <th>Luas Lahan</th>
                  <th>Status</th>
                  <th 
                  <?php 

                  if ($_SESSION['role_id'] == 1) {
                    echo "width='13%'";
                  } elseif ($_SESSION['role_id'] == 2) {
                    echo "width='23%'";
                  } elseif ($_SESSION['role_id'] == 3) {
                    echo "width='13%'";
                  } 
                  ?>
                  >Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $month = GetRomawiFromNumber(date('m', strtotime($row['app_date'])));
                $year = date('Y', strtotime($row['app_date']));
                $no++
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><a style="cursor : pointer;" id="id_terms" onclick="getDetail('<?php echo $row['idm_application']?>')"><?php echo str_pad($row['idm_application'], 3, '0', STR_PAD_LEFT)."/PKRK/CKTR/".$month."/".$year; ?></a></td>
                  <td><?php echo $row['app_date']; ?></td>
                  <td><?php echo $row['app_name']; ?></td>
                  <td><?php echo $row['app_owner_address']; ?></td>
                  <td><?php echo $row['app_land_area']; ?></td>
                  <td><b><?php echo $row['app_status']; ?></b></td>
                  <td>
                  <?php 
                  if ($_SESSION['role_id'] == 1) {?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Disetujui')">Setujui</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Ditunda')">Tolak</a>
                  <?php } elseif ($_SESSION['role_id'] == 2) { ?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Diterima')">Diterima</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-success" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Ditunda')">Tunda</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Ditolak')">Tolak</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-warning" id="approve" onclick="updateStatus('<?php echo $row['idm_application'];?>','Batal')">Batal</a>
                  <?php } elseif ($_SESSION['role_id'] == 3) {?>
                    <a style="cursor : pointer;" type="button" href="<?php echo "http://www.google.com/maps/place/".$row['app_lat'].",".$row['app_long']."/@".$row['app_lat'].",".$row['app_long'].",17z/data=!3m1!1e3".$row['app_status']; ?>" target="_blank" class="btn btn-sm btn-warning" id="approve">Lokasi</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="unggah('<?php echo $row['idm_application'];?>','Unggah')">Unggah</a>
                  <?php }
                  ?>
                  </td>
                </tr>
                <?php
                }?>
                </tbody>
                </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
    <div class="modal" id="comment">
      <form role="form" id="comment-method" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Komentar</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" id="mode" name="mode">
                <input type="hidden" id="app_id" name="app_id">
                <input type="hidden" id="type" name="type">
                <textarea type="text" class="form-control" id="app_komentar" name="app_komentar" rows="5" autocomplete="off" required></textarea>   
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="width:90px;">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Batal</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
    <!-- /.modal-dialog -->
    </div>
     <div class="modal" id="unggah">
      <form role="form" id="unggah-method" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Unggah Foto Lokasi</h4>
              </div>
              <div class="modal-body"> 
                  <input type="text" class="form-control" id="app_id_unggah" name="app_id_unggah">
                  <input type="text" class="form-control" id="mode_unggah" name="mode_unggah"><div class="form-group">
                  <input type="file" class="form-control" id="file" name="files[]" multiple="multiple" accept="image/*" required>
                  <small>&nbsp;* file format JPG. Maximum upload file size 2Mb.</small>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="width:90px;">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:90px;">Batal</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
    <!-- /.modal-dialog -->
    </div>  

 <script type="text/javascript">
    $(document).ready(function() {
      $(window).scrollTop(0);
       $('#comment-method').submit(function(e){
          e.preventDefault();
          var inputs = $(this).serialize();
            $.post("pages/data/submit.php", inputs, function(data){
              $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 

              $('#comment').modal('hide');
              $("#konten").load("pages/data/krk.php");
            },'json');
          });

       $('#unggah-method').submit(function(e){
          e.preventDefault();
          var inputs = new FormData(this.form); 
          alert(inputs);
            $.post("pages/data/submit.php", inputs, function(data){
              $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 

              $('#unggah').modal('hide');
              $("#konten").load("pages/data/krk.php");
            },'json');
          });

      $('#data-krk').DataTable();
    });
    
    function updateStatus(id, type){
      var app_id = id;
      var mode = 'status';
      var type = type;

      $('#comment').modal('show');
      $("#app_id").val(app_id);
      $("#mode").val(mode);
      $("#type").val(type);

    } 

    function unggah(id){
      var app_id = id;
      var mode = 'unggah';
      $('#unggah').modal('show');
      $("#app_id_unggah").val(app_id);
      $("#mode_unggah").val(mode);
    } 

    function getDetail(id){
      var id =  id;
      $("#konten").load("pages/data/detail.php", { 
         'id': id
        });
    }
    </script>
