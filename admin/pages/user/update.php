<?php
include_once './includes/user.inc.php';

$user = new User($db);

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $user->id = $_POST['uid'];
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
    
    if($user->update()){
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Edit pengguna berhasil";
      header('location:index.php?m=krk_usr');
    } else {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = "Edit pengguna gagal";
    }
} else {
  $id=$_GET['uid'];
  $user->id = $id;
  $user->readOne();
}

?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Pengguna
        <small>Edit</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit Pengguna</h3>
            </div>
            <form  id="user" name="user" method="POST" action="index.php?m=krk_edit_usr&uid=c4ca4238a0b923820dcc509a6f75849b">
              <div class="box-body">
               <div class="col-md-4">
               <div class="form-group">
                  <label for="namaLengkap">Nama Lengkap</label>
                  <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $id;?>">
                  <input type="name" class="form-control" id="user_full_name" name="user_full_name" placeholder="Nama Lengkap" value="<?php echo $user->user_full_name;?>">
                </div>
                <div class="form-group">
                  <label for="namaPengguna">Nama Pengguna</label>
                  <input type="username" class="form-control" id="user_name" name="user_name" placeholder="Nama Pengguna" value="<?php echo $user->user_name;?>">
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="nip" class="form-control" id="user_nip" name="user_nip" placeholder="NIP" value="<?php echo $user->user_nip;?>">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea type="text" class="form-control" id="user_address" name="user_address" required><?php echo $user->user_address;?></textarea>  
                </div>
                <div class="form-group">
                  <label for="nomertelpon">Nomer Telpon</label>
                  <input type="nomertelpon" class="form-control" id="user_telpon" name="user_telpon" placeholder="Nomer Telpon" value="<?php echo $user->user_telpon;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter email" value="<?php echo $user->user_email;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" value="<?php echo $user->user_password;?>">
                </div>
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

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>
    </section>
  </div>

