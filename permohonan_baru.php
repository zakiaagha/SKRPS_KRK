<?php
include_once 'header.php';
if($_POST){
	
	include_once 'admin/includes/application.inc.php';
	$eks = new Application($db);

	$eks->app_name = $_POST['app_name'];
	$eks->app_address = $_POST['app_address'];
	$eks->app_nik = $_POST['app_nik'];
	$eks->app_owner_name = $_POST['app_owner_name'];
	$eks->app_owner_address= $_POST['app_owner_address'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="index.php">lihat semua data</a>.
</div>
<?php
	}
	
	else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>

  <main id="main">
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <h3 style="color: #fff;">Permohonan Baru</h3>
      </div>
    </section>


    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">	
          <form action="index.php?hal=permohonan_baru" method="post">	
			<div class="form-group">
				<label for="tp">Nama Pemohon</label>
				<input type="text" class="form-control" id="app_name" name="app_name" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Pemohon</label>			
				<textarea type="text" class="form-control" id="app_address" name="app_address" required></textarea>	    
			</div>
			<div class="form-group">
				<label for="jm">Nama Pemilik Lahan</label>				    
				<input type="text" class="form-control" id="app_owner_name" name="app_owner_name" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Lokasi</label>				    
				<textarea type="text" class="form-control" id="app_owner_address" name="app_owner_address" required></textarea>	    
			</div>
			<div class="form-group">
				<label for="jm">NIK</label>				    
				<input type="text" class="form-control" id="app_nik" name="app_nik" required>
			</div>
			<div class="form-group">
				<label for="jm">No PL</label>				    
				<input type="text" class="form-control" id="no_pl" name="no_pl" required>
			</div>	  
			<div class="form-group">
				<label for="jm">No Sertifikat</label>				    
				<input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" required>
			</div>	  
			<div class="form-group">
				<label for="jm">Luas Lahan</label>				    
				<input type="text" class="form-control" id="luas_lahan" name="luas_lahan" required>
			</div>	  
			<div class="form-group">
				<label for="jm">Peruntukan Lahan</label>				    
				<input type="text" class="form-control" id="peruntukan_lahan" name="peruntukan_lahan" required>
			</div>	  	  
			<div class="form-group">
				<label for="jm">Peruntukan Bangunan</label>				    
				<input type="text" class="form-control" id="peruntukan_bangunan" name="peruntukan_bangunan" required>
			</div>	
			<div class="form-group">
				<label for="kt">Ketinggian Bangunan Maksimum</label>
				<input type="text" class="form-control" id="ketinggian_maksimum" name="ketinggian_maksimum" required>
			</div><br>
		  </div>
		  <div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="kt">Jumlah Lantai</label>
				<input type="text" class="form-control" id="jumlah_lantai" name="jumlah_lantai" required>
			</div>
			<div class="form-group">
				<label for="kt">GSB Depan Minimum</label>
				<input type="text" class="form-control" id="gsbdm" name="gsbdm" required>
			</div>
			<div class="form-group">
				<label for="kt">GSB Samping Kanan Minimum</label>
				<input type="text" class="form-control" id="gsbskn" name="gsbskn" required>
			</div>
			<div class="form-group">
				<label for="kt">GSB Samping Kiri Minimum</label>
				<input type="text" class="form-control" id="gsbskr" name="gsbskr" required>
			</div>
			<div class="form-group">
				<label for="kt">GSB Belakang Minimum</label>
				<input type="text" class="form-control" id="gsbblk" name="gsbblk" required>
			</div>
			<div class="form-group">
				<label for="kt">KDB (Koefisien Dasar Bangunan) Maksimum</label>
				<input type="text" class="form-control" id="kdb" name="kdb" required>
			</div>
			<div class="form-group">
				<label for="kt">KLB (Koefisien Lantai Bangunan) Maksimum</label>
				<input type="text" class="form-control" id="klb" name="klb" required>
			</div>
			<div class="form-group">
				<label for="kt">KDH (Koefisien Daerah Hijau) Minimum</label>
				<input type="text" class="form-control" id="kdh" name="kdh" required>
			</div>
			<div class="form-group">
				<label for="kt">KTB (Koefisien Tapak Basement) Maksimum</label>
				<input type="text" class="form-control" id="ktb" name="ktb" required>
			</div>
			<div class="form-group">
				<label for="kt">Jaringan Utilitas</label>
				<input type="text" class="form-control" id="utilitas" name="utilitas" required>
			</div>
			<div class="form-group">
				<label for="kt">Informasi Teknis Lainnya</label>
				<input type="text" class="form-control" id="inform" name="inform" required>
			</div>  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12">
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='index.php'" class="btn btn-success">Kembali</button>
		  </form>
		  </div>
		</div>
      </div>
    </section><!-- #about -->

    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
      </div>
    </section>


    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp">
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