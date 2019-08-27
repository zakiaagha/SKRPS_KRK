<?php 
include_once ("../../include/application.inc.php");
include_once ("../../include/config.php");
$config = new Config();
$db = $config->getConnection();

$app = new Application($db);
$id=$_POST['id'];
$app->id = $id;
$app->readOne();
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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Pengguna</h3>
            </div>
            <!-- /.box-header -->

             <form role="form" method="post" id="add-user">
              <div class="box-body">
                <input type="hidden" class="form-control" id="mode" name="mode" placeholder="Nama Lengkap" value="create">
               <div class="col-md-4">
               <div class="form-group">
                  <label for="namaLengkap">Nama Lengkap</label>
                  <input type="name" class="form-control" id="user_full_name" name="user_full_name" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <label for="namaPengguna">Nama Pengguna</label>
                  <input type="username" class="form-control" id="user_name" name="user_name" placeholder="Nama Pengguna" required>
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="nip" class="form-control" id="user_nip" name="user_nip" placeholder="NIP" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea type="text" class="form-control" id="user_address" name="user_address" required></textarea>  
                </div>
                <div class="form-group">
                  <label for="nomertelpon">Nomer Telpon</label>
                  <input type="nomertelpon" class="form-control" id="user_telpon" name="user_telpon" placeholder="Nomer Telpon">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" required>
                </div>
                <!-- select -->
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" id="user_role" name="user_role">
                    <option value="1">Admin</option>
                    <option value="2">Operator</option>
                    <option value="3">surveyor</option>
                  </select>
                </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->          
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">

    $(document).ready(function() {
      $('#add-user').submit(function(e){
          e.preventDefault();
          var inputs = $(this).serialize();
            $.post("pages/user/submit.php", inputs, function(data){
              $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 
            $("#konten").load("pages/user/user.php");
                
            },'json');
          });
      });
    </script>

