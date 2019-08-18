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
                  <th width="5%">No</th>
                  <th>Nomor</th>
                  <th>Nama Pemohon</th>
                  <th>Tanggal</th>
                  <th>No. Sertipikat</th>
                  <th>No. PL</th>
                  <th>Luas Lahan</th>
                  <th>Peruntukan Bangunan</th>
                  <th>Status</th>
                  <th>Action</th>
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
                  <td><?php echo $row['app_name']; ?></td>
                  <td><?php echo $row['app_date']; ?></td>
                  <td><?php echo $row['app_certificate_no']; ?></td>
                  <td><?php echo $row['app_pl_no']; ?></td>
                  <td><?php echo $row['app_land_area']; ?></td>
                  <td><?php echo $row['app_building_allotment']; ?></td>
                  <td><?php echo $row['app_status']; ?></td>
                  <td>
                  <?php 
                  if ($_SESSION['role_id'] == 1) {?>
                   <a style="cursor : pointer;" type="button" class="btn btn-block btn-block btn-sm btn-info" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Setujui</a>
                  <?php } elseif ($_SESSION['role_id'] == 2) { ?>
                    <a style="cursor : pointer;" type="button" class="btn btn-block btn-block btn-sm btn-info" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Verifikasi</a>
                  <?php } elseif ($_SESSION['role_id'] == 3) {?>
                    <a style="cursor : pointer;" type="button" class="btn btn-block btn-block btn-sm btn-info" id="approve" onclick="approveBill('<?php echo $row['idft_receive_bill'];?>')">Unggah</a>
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


