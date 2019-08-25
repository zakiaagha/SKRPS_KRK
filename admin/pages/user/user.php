<?php
  session_start();
  include_once ("../../include/login.inc.php");
  include_once ("../../include/config.php");
  $config = new Config();
  $db = $config->getConnection();

  $user = new Login($db);
  $stmt=$user->readAll();
  ?>
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
              <h3 class="box-title">Daftar Pengguna <?php if ($_SESSION["userMsg"] <> "") {
  echo 'dddd';
}?></h3>     
              <div class="pull-right">
                <a><button type="button" class="btn btn-primary" id="add_user"><i class="fa fa-plus"></i>&emsp;Tambah Pengguna</button></a>
              </div>
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
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-warning" id="approve" onclick="getDetail('<?php echo $row['idm_user'];?>')"><i class="fa fa-edit"></i></a>&nbsp;
                    <a style="cursor : pointer;" type="button" class="btn btn-sm btn-danger" id="approve" onclick="deleteUser('<?php echo $row['idm_user'];?>')"><i class="fa fa-trash"></i></a>
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

<script>
    $(window).scrollTop(0);
    $("#add_user").click(function(){
      $("#konten").load("pages/user/add.php");
    });
    $('#data-user').DataTable();

    function deleteUser(id){
      var id =  id;
      var mode = "delete";
        $.post("pages/user/submit.php", {'id':id, 'mode':mode}, function(data){
              $( "#konten" ).load( "pages/user/user.php", function() {
                    $.bootstrapGrowl(data.msg,{
                     type: data.type,
                     delay: 2000,
                    }); 
                  });
                
            },'json');
    }
    function getDetail(id){
      var id =  id;
      $("#konten").load("pages/user/update.php", { 
         'id': id
        });
    }
</script>