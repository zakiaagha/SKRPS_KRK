<?php
include_once 'header.php';
if($_POST){
	
	include_once 'admin/includes/application.inc.php';
	$eks = new Application($db);

	/*$temp_ktp   = $_FILES['ktp']['tmp_name'];
	$name_ktp   = $_FILES['ktp']['name'];
	$size_ktp   = $_FILES['ktp']['size'];
	$type_ktp   = $_FILES['ktp']['type'];

	$temp_pl   = $_FILES['pl']['tmp_name'];
	$name_pl   = $_FILES['pl']['name'];
	$size_pl   = $_FILES['pl']['size'];
	$type_pl   = $_FILES['pl']['type'];

	$temp_sertifikat   = $_FILES['sertifikat']['tmp_name'];
	$name_sertifikat   = $_FILES['sertifikat']['name'];
	$size_sertifikat   = $_FILES['sertifikat']['size'];
	$type_sertifikat   = $_FILES['sertifikat']['type'];

	$temp_akte   = $_FILES['akte']['tmp_name'];
	$name_akte   = $_FILES['akte']['name'];
	$size_akte   = $_FILES['akte']['size'];
	$type_akte   = $_FILES['akte']['type'];

	$temp_pbb   = $_FILES['pbb']['tmp_name'];
	$name_pbb   = $_FILES['pbb']['name'];
	$size_pbb   = $_FILES['pbb']['size'];
	$type_pbb   = $_FILES['pbb']['type'];

	$temp_sibp   = $_FILES['sibp']['tmp_name'];
	$name_sibp   = $_FILES['sibp']['name'];
	$size_sibp   = $_FILES['sibp']['size'];
	$type_sibp   = $_FILES['sibp']['type'];

	$temp_keabsahan = $_FILES['keabsahan']['tmp_name'];
	$name_keabsahan = $_FILES['keabsahan']['name'];
	$size_keabsahan = $_FILES['keabsahan']['size'];
	$type_keabsahan = $_FILES['keabsahan']['type'];

	$temp   = $_FILES['imb']['tmp_name'];
	$name   = $_FILES['imb']['name'];
	$size   = $_FILES['imb']['size'];
	$type   = $_FILES['imb']['type'];

	$temp   = $_FILES['imb']['tmp_name'];
	$name   = $_FILES['imb']['name'];
	$size   = $_FILES['imb']['size'];
	$type   = $_FILES['imb']['type'];

	$temp   = $_FILES['imb']['tmp_name'];
	$name   = $_FILES['imb']['name'];
	$size   = $_FILES['imb']['size'];
	$type   = $_FILES['imb']['type'];*/

	$format_file = array("zip", "pdf");
	$max_file_size = 1024*(1024*5); //maksimal 100 kb
	$path = "admin/upload/"; // Lokasi folder untuk menampung file
	$count = 0;
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		// Loop $_FILES to exeicute all files
		foreach ($_FILES['files']['name'] as $f => $name) {     
		    if ($_FILES['files']['error'][$f] == 4) {
		        continue; // Skip file if any error found
		    }	       
		    if ($_FILES['files']['error'][$f] == 0) {	           
		        if ($_FILES['files']['size'][$f] > $max_file_size) {
		            $message[] = "$name is too large!.";
		            continue; // Skip large files
		        }
				elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $format_file) ){
					$message[] = "$name is not a valid format";
					continue; // Skip invalid file formats
				}
		        else{ // No error found! Move uploaded files 
		            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
		            $count++; // Number of successfully uploaded file
		        }
		    }
		}
		echo 'berhasil upload '.$count.' files';
	}
	/*
	$eks->app_name = $_POST['app_name'];
	$eks->app_address = $_POST['app_address'];
	$eks->app_nik = $_POST['app_nik'];
	$eks->app_owner_name = $_POST['app_owner_name'];
	$eks->app_owner_address= $_POST['app_owner_address'];*/

	if($eks->insert()){
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
	
    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
      	<?php if ($_SESSION["errorMsg"] <> "") { ?>
        <div class="alert alert-<?php echo $_SESSION["errorType"] ?> alert-dismissable"><?php echo $_SESSION["errorMsg"]; ?></div>
    	<?php } ?><br>
        <div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">	
          <form action="index.php?hal=permohonan_baru" method="post" enctype="multipart/form-data">	
			<div class="form-group">
				<label for="tp">Nama Pemohon</label>
				<input type="text" class="form-control" id="app_name" name="app_name" required>
			</div>
			<div class="form-group">
				<label for="jm">NIK</label>				    
				<input type="text" class="form-control" id="app_nik" name="app_nik" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Pemohon</label>			
				<textarea type="text" class="form-control" id="app_address" name="app_address" required></textarea>	 
			</div>
			<div class="form-group">
				<label for="jm">No HP</label>			
				<input type="text" class="form-control" id="app_telepon" name="app_telepon" required>   
			</div>
			<div class="form-group">
				<label for="jm">Atas Nama/Pemilik Tanah</label>				    
				<input type="text" class="form-control" id="app_owner_name" name="app_owner_name" required>
			</div>
			<div class="form-group">
				<label for="jm">Alamat Lokasi</label>	    
				<textarea type="text" class="form-control" id="app_owner_address" name="app_owner_address" required></textarea>	
			</div>  
			<div class="form-group">
				<label for="jm">Luas Tanah</label>	    
				<input type="text" class="form-control" id="app_land_area" name="app_land_area" required> 
			</div>  
			<div class="form-group">
				<label for="jm">Kelengkapan Administrasi</label>	   
				<input type="file" class="form-control" id="file" name="files[]" multiple="multiple" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<!-- <div class="form-group">
				<label for="jm">PL</label>	   
				<input type="file" class="form-control" id="pl" name="pl" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Sertifikat</label>	   
				<input type="file" class="form-control" id="sertifikat" name="sertifikat" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Akte Notaris</label>	   
				<input type="file" class="form-control" id="akte" name="akte" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Bukti Lunas PBB</label>	   
				<input type="file" class="form-control" id="pbb" name="pbb" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">SIBP</label>	   
				<input type="file" class="form-control" id="sibp" name="sibp" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Surat Pernyataan Keabsahan Dokumen</label>	   
				<input type="file" class="form-control" id="keabsahan" name="keabsahan" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>			
			<div class="form-group">
				<label for="jm">Surat Kuasa</label>	   
				<input type="file" class="form-control" id="surat_kuasa" name="surat_kuasa" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">IMB Lama</label>	   
				<input type="file" class="form-control" id="imb_lama" name="imb_lama" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Dokumen lain - lain </label>	   
				<input type="file" class="form-control" id="lain_lain" name="lain_lain" required>
				<small>&nbsp;* file format Zip. Maximum upload file size 5Mb.</small>
			</div>	   -->
			<br>
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
	<script type="text/javascript">
		
    $(document).ready(function() {
    	 $('#app_date').datepicker({
          todayHighlight: true,
          autoclose: true,
          format: 'yyyy-mm-dd'
        })
    });
	</script>