<?php
include_once 'includes/application.inc.php';

  $app = new Application($db);

  $stmt=$app->readAll();
  ?>
  <div class="content-wrapper">
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
                <table id="data" class="table table-bordered table-hover">
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
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Setujui</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Tolak</a>
                  <?php } elseif ($_SESSION['role_id'] == 2) { ?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-primary" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Diterima</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-success" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Tunda</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="tunda('<?php echo md5($bill_id);?>')">Tolak</a>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-warning" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Batal</a>
                  <?php } elseif ($_SESSION['role_id'] == 3) {?>
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-info" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Unggah Photo</a>
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
  </div>

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
      function tunda(id){
        var bill_id = bill_id;
        $('#comment').modal('show');
        $(":input[type='submit']").show();
        $("#bill_no").val(bill_id);
      }
    </script>
