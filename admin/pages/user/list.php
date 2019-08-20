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
              <div class="pull-right">
                <a href = "?m=krk_add_usr" ><button type="button" class="btn btn-primary" id="add_user"><i class="fa fa-plus"></i>&emsp;Tambah Pengguna</button></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Username</th>
                  <th>NIP</th>
                  <th>Level</th>
                  <th width="13%">Action</th>
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
                  <td>
                    <a href="?m=krk_edit_usr&uid=<?php echo md5($row['idm_user'])?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="?m=krk_del_usr" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
                }?>
                </tbody>
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
