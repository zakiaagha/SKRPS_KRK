<?php
include_once './includes/user.inc.php';
$user = new User($db);
if($_POST){
    $user->user_name=$_POST['user_name'];
    $user->user_full_name=$_POST['user_full_name'];
    $user->user_nip=$_POST['user_nip'];
    $user->user_email=$_POST['user_email'];
    $user->user_password=md5($_POST['user_password']);
    $user->user_address=$_POST['user_address'];
    $user->user_telpon=$_POST['user_telpon'];
    $user->user_role=$_POST['user_role'];
    $user->uid=$_SESSION['user_name'];
    $user->datenow=date("Y-m-d H:i:s");  
    
    if($user->insert()){
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Penambahan pengguna berhasil";
      // echo "<script type='text/javascript' >alert('".$_SESSION['role_id']."')</script>";
       header('location:index.php?m=krk_usr');
    } else {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = "Penambahan pengguna gagal";
    }
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
        <small>Tambah</small>
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

            <form  id="user" name="user" method="POST" action="index.php?m=krk_add_usr">
              <div class="box-body">
               <div class="col-md-4">
               <div class="form-group">
                  <label for="namaLengkap">Nama Lengkap</label>
                  <input type="name" class="form-control" id="user_full_name" name="user_full_name" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <label for="namaPengguna">Nama Pengguna</label>
                  <input type="username" class="form-control" id="user_name" name="user_name" placeholder="Nama Pengguna">
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="nip" class="form-control" id="user_nip" name="user_nip" placeholder="NIP">
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
                  <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
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
  </div>

