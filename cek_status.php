<?php
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
  include_once ("admin/include/application.inc.php");
  include_once ("admin/include/config.php");
  $config = new Config();
  $db = $config->getConnection();
  
  $app = new Application($db);
  $app->app_nik = $_POST['app_nik'];
  $stmt=$app->readByNik();
}
?>

  <main id="main">

    <section id="call-to-action">
      <div class="container">
        <h3 style="color: #fff;">Cek Status Pengajuan KRK</h3>
      </div>
    </section>

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow">
      <div class="container">
        <form action="index.php?hal=cek_status" method="post" enctype="multipart/form-data"> 
        <div class="row">
          <div class="col-lg-4">
            <input type="text" class="form-control" id="app_nik" name="app_nik" autocomplete="off" placeholder="Masukkan NIK" required>
          </div>
          <div class="col-lg-1">
            <button type="submit" class="btn btn-primary">Cari</button>
          </div>
        </div>  
        </form>  
        <br>    
        <div class="col-xs-12 col-lg-12 table-responsive">
                <table id="data-krk" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="3%">No</th>
                  <th>Nomor</th>
                  <th>Tanggal</th>
                  <th>Nama Pemohon</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
              
                </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
                 
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $month = GetRomawiFromNumber(date('m', strtotime($row['app_date'])));
                $year = date('Y', strtotime($row['app_date']));
                $no++;
              /*   if (isset($row['idm_application'])) {
                    echo 'yes';
                  } else {
                    echo 'yes';
                  }*/
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><a style="cursor : pointer;" id="id_terms" onclick="getDetail('<?php echo $row['idm_application']?>')"><?php echo str_pad($row['idm_application'], 3, '0', STR_PAD_LEFT)."/PKRK/CKTR/".$month."/".$year; ?></a></td>
                  <td><?php echo $row['app_date']; ?></td>
                  <td><?php echo $row['app_name']; ?></td>
                  <td><?php echo $row['app_owner_address']; ?></td>
                  <td><?php 
                  if ($row['app_status'] == "Diterima") {
                     $color = '#3951AE';
                  } elseif ($row['app_status'] == 'Ditunda') {
                     $color = '#3951AE';
                  } elseif ($row['app_status'] == 'Ditolak') {
                     $color = '#C62412';
                  } elseif ($row['app_status'] == 'Batal') {
                     $color = '#E8A010';
                  } elseif ($row['app_status'] == 'Disetujui') {
                     $color = '#3A6FD8';
                  }
                   echo "<b style='color:".$color."'>".$row['app_status']."</b>"; ?></td>
                  <td><?php echo $row['app_comment']; ?></td>
                  <td>
                    <?php 
                    if ($row['app_status'] == 'Ditunda') {
                      echo "<a style='cursor : pointer; color: #fff;' type='button' class='btn btn-sm btn-primary' id='edit' href='index.php?hal=ubah&id=".$row['idm_application']."')'>Edit</a>";
                    } ?>
                  </td>
                </tr>
                <?php
                }
              }
                ?>
                </tbody>
                </table>
        </div>
      </div>
    </section><!-- #about -->

    <br>
    <section id="call-to-action" class="wow">
      <div class="container">
      </div>
    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow">
      <div class="container">
        <div class="section-header">
          <h2>Kontak</h2>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Alamat</h3>
              <address>Jalan Kartini I Nomor 29, Sekupang Batam Kepulauan Riau, 29425</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Telepon</h3>
              <p><a href="tel:+155895548855">++62 778 801 4170</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:sekretariatcktr@gmail.com">sekretariatcktr@gmail.com</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.153542523604!2d103.94521947870524!3d1.1046831953817804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x62a980f46efa16f2!2sDinas+Cipta+Karya+dan+Tata+Ruang+Batam!5e0!3m2!1sid!2sid!4v1566105586418!5m2!1sid!2sid" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </section><!-- #contact -->

  </main>
		
		<?php
?>