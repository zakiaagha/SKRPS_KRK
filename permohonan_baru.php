<?php
include_once 'header.php';
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	include_once 'admin/includes/application.inc.php';
	$app = new Application($db);

	$format_file = array("zip", "pdf");
	$max_file_size = 1024*(1024*5); 
	$path = "admin/upload/"; 
	$count = 0;
	$app->app_name = $_POST['app_name'];
	$app->app_address = $_POST['app_address'];
	$app->app_nik = $_POST['app_nik'];
	$app->app_telepon = $_POST['app_telepon'];
	$app->app_owner_name = $_POST['app_owner_name'];
	$app->app_owner_address= $_POST['app_owner_address'];
	$app->app_land_area = $_POST['app_land_area'];
	
	if($app->insert()){
	  $seq=0;
	  foreach ($_FILES['files']['name'] as $f => $name) { 
	  	$seq++   ;
		if ($_FILES['files']['error'][$f] == 4) {
			continue; // Skip 
		}	       
		if ($_FILES['files']['error'][$f] == 0) {	           
			if ($_FILES['files']['size'][$f] > $max_file_size) {
		    	$message[] = "$name is too large!.";
		        continue;
			} elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $format_file) ) {
				$message[] = "$name is not a valid format";
				continue; 
			} else {
		  		if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
		    	$count++;
			}
		}

		$app->app_file_temp = $_FILES['files']['tmp_name'][$f];
		$app->app_file_name = $_FILES['files']['name'][$f];
		$app->app_file_type = $_FILES['files']['type'][$f];
		$app->app_file_size = $_FILES['files']['size'][$f];
		$app->app_seq_file = $seq;
		$app->insertAttachment();
	  }	
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Permohonan Baru Berhasil.";
	} else {
      $_SESSION["errorType"] = "gagal";
      $_SESSION["errorMsg"] = "Permohonan Baru gagal.";
	}
}
?>

  <main id="main">
    <section id="call-to-action">
      <div class="container">
        <h3 style="color: #fff;">Permohonan Baru</h3>
      </div>
    </section>
	
    <section class="wow">
      <div class="container">
      	<?php if ($_SESSION["errorMsg"] <> "") { ?>
        <div class="alert alert-<?php echo $_SESSION["errorType"] ?> alert-dismissable"><?php echo $_SESSION["errorMsg"]; ?></div>
    	<?php } ?><br>
        <div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">	
          <form action="index.php?hal=permohonan_baru" method="post" enctype="multipart/form-data">	
			<div class="form-group">
				<label for="jm">Nama Pemohon</label>				    
				<input type="text" class="form-control" id="app_name" name="app_name" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="jm">NIK</label>				    
				<input type="text" class="form-control" id="app_nik" name="app_nik" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Pemohon</label>			
				<textarea type="text" class="form-control" id="app_address" name="app_address" autocomplete="off" required></textarea>	 
			</div>
			<div class="form-group">
				<label for="jm">No HP</label>			
				<input type="Number" class="form-control" id="app_telepon" name="app_telepon" autocomplete="off" required>   
			</div>
			<div class="form-group">
				<label for="jm">Atas Nama/Pemilik Tanah</label>				    
				<input type="text" class="form-control" id="app_owner_name" name="app_owner_name" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Lokasi</label>	    
				<textarea type="text" class="form-control" id="app_owner_address" name="app_owner_address" autocomplete="off" required></textarea>	
			</div>  
			<div class="form-group">
				<label for="jm">Luas Tanah</label>	    
				<input type="text" class="form-control" id="app_land_area" name="app_land_area" autocomplete="off" required> 
			</div>  
			<div class="form-group">
				<label for="jm">KTP</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">PL</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Sertifikat</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Akte Notaris</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Bukti Lunas PBB</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">SIBP</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Surat Pernyataan Keabsahan Dokumen</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>			
			<div class="form-group">
				<label for="jm">Surat Kuasa</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">IMB Lama</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>	
			<div class="form-group">
				<label for="jm">Berkas Lainnya</label>	   
				<input type="file" class="form-control" id="file" name="files[]" multiple="multiple" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<br>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12">
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='index.php'" class="btn btn-success">Kembali</button>
		  </form>
		  </div>
		</div>
      </div>
    </section><br><br><br><br>

    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
      </div>
    </section>

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
    </section>

  </main>
	<script type="text/javascript">
		
    $(document).ready(function() {
    	 $('#app_date').datepicker({
          todayHighlight: true,
          autoclose: true,
          format: 'yyyy-mm-dd'
        })
    });
	</script>