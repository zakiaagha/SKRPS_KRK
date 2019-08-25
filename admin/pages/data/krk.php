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
                    echo "width='3%'";
                  } 
                  ?>
                  >Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $no++
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><a href="#"><?php echo $row['idm_application']."/PKRK/CKTR"; ?></a></td>
                  <td><?php echo $row['app_date']; ?></td>
                  <td><?php echo $row['app_name']; ?></td>
                  <td><?php echo $row['app_owner_address']; ?></td>
                  <td><?php echo $row['app_land_area']; ?></td>
                  <td><?php echo $row['app_status']; ?></td>
                  <td>
                  <?php 
                  if ($_SESSION['role_id'] == 1) {?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="setuju('<?php echo $row['idm_application'];?>')">Setujui</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="tolak('<?php echo $row['idm_application'];?>')">Tolak</a>
                  <?php } elseif ($_SESSION['role_id'] == 2) { ?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="terima('<?php echo $row['idm_application'];?>')">Diterima</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-success" id="approve" onclick="tunda('<?php echo $row['idm_application'];?>')">Tunda</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="tolak('<?php echo $row['idm_application'];?>')">Tolak</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-warning" id="approve" onclick="batal('<?php echo $row['idm_application'];?>')">Batal</a>
                  <?php } elseif ($_SESSION['role_id'] == 3) {?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-info" id="approve" onclick="unggah('<?php echo $row['idm_application'];?>')">Unggah Photo</a>
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
      <form role="form" id="print-method" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Komentar</h4>
              </div>
              <div class="modal-body">
                <input type="text" id="app_id" name="app_id">
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

    

 <script type="text/javascript">

    $('#data-krk').DataTable();
    $("#comment").submit(function(){
      var inputs = $(this).serialize();
      alert(inputs);
    /*
        e.preventDefault();*//*
        $('#comment').modal('hide');*//*
        $.post("pages/data/submit.php", inputs, function(data){*//*
          $("#comment").load(location.href+" #comment>*", function() {
                    $.bootstrapGrowl('berhasil',{
                      type: 'success',
                      delay: 2000,
                    }); 
                  });*/
      /*
            });*/
      });
      function tunda(id){
        var app_id = id;
        $('#comment').modal('show');
        $("#app_id").val(app_id);
      }

      
    </script>
