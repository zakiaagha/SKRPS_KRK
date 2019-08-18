<?php
include_once 'includes/login.inc.php';

  $user = new Login($db);

  $stmt=$user->readAll();
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data-user" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Username</th>
                  <th>NIP</th>
                  <th>Level</th>
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
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['user_nip']; ?></td>
                  <td><?php echo $row['role_name']; ?></td>
                  <td>X</td>
                </tr>
                <?php
                }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


