<?php
include_once 'header.php';
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	include_once 'admin/include/application.inc.php';
	include_once 'admin/include/config.php';
	$config = new Config();
	$db = $config->getConnection();
	$app = new Application($db);
	
	$sql = "SELECT max(app_req_no) as no FROM krk_applications WHERE YEAR(app_date) = YEAR(CURDATE());";
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $no = $stmt->fetch();
    if ($no['no'] == ''){
    	$req_no = '1';
    } else {
    	$req_no = $no['no']+1;
    }

	$format_file = array("zip", "pdf");
	$path = "admin/upload/pdf/"; 
	$count = 0;
	$app->app_name = $_POST['app_name'];
	$app->app_req_no = $req_no;
	$app->app_address = $_POST['app_address'];
	$app->app_nik = $_POST['app_nik'];
	$app->app_telepon = $_POST['app_telepon'];
	$app->app_owner_name = $_POST['app_owner_name'];
	$app->app_owner_address= $_POST['app_owner_address'];
	$app->app_land_area = $_POST['app_land_area'];
	$app->app_proposed_land_area = $_POST['app_proposed_land_area'];
	$app->app_certificate_no = $_POST['app_certificate_no'];
	$app->app_pl_no = $_POST['app_pl_no'];
	$app->app_allotment_perpres = $_POST['app_allotment_perpres'];
	$app->app_allotment_prov = $_POST['app_allotment_prov'];
	$app->app_building_allotment = $_POST['app_building_allotment'];
	$app->app_imb_no = $_POST['app_imb_no'];
	$app->app_lat = $_POST['app_lat'];
	$app->app_long = $_POST['app_long'];
	$app->app_date=date("Y-m-d");
	$app->uid=$_POST['app_name'];
	$app->datenow=date("Y-m-d H:i:s");
	$app->app_comment='Permohonan berhasil, waktu proses pengecekan berkas 3-5 hari kerja';

	try{
		$db->beginTransaction();
		  $seq=0;

		  foreach ($_FILES['files']['name'] as $f => $name) { 
			$max_file_size = 5 * 1048576; 
		  	$seq++   ;	       
		  	if ($_FILES['files']['size'][$f] > $max_file_size) {
				$_SESSION["errorType"] = "danger";
			    $_SESSION["errorMsg"] = "File terlalu besar. Maksimal ukuran file 5Mb";
			    break;
			}			
		  }	

		  if ($_SESSION["errorType"] <> "danger"){
		  	$app->insert();
			foreach ($_FILES['files']['name'] as $f => $name) { 
			  	$seq++   ;	       
			  	$name_file = $app->app_id."_".$name;
				$app->app_file_temp = $_FILES['files']['tmp_name'][$f];
				$app->app_file_name = $app->app_id."_".$_FILES['files']['name'][$f];
				$app->app_file_type = $_FILES['files']['type'][$f];
				$app->app_file_size = $_FILES['files']['size'][$f];
				$app->app_seq_file = $seq;
				$app->insertAttachment();
				if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name_file))
				$count++;
				$_SESSION["errorType"] = "success";
		      	$_SESSION["errorMsg"] = "Permohonan Baru Berhasil.";
			}
		  }
		$db->commit();
	} catch (Exception $Ex) {
      $db->rollBack();
      $_SESSION["errorType"] = "danger";
	  $_SESSION["errorMsg"] = $Ex->getMessage();
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
      <div class="container"><br>
      	<?php if ($_SESSION["errorMsg"] <> "") { ?>
        <div class="alert alert-<?php echo $_SESSION["errorType"] ?> alert-dismissable"><?php echo $_SESSION["errorMsg"]; ?></div>
    	<?php } ?><br>
        <div class="row">
		  <div class="col-xs-12 col-sm-7 col-md-7">	
          <form action="index.php?hal=permohonan_baru" method="post" enctype="multipart/form-data">	
			<div class="form-group">
				<label for="jm">Nama Pemohon</label>	
				<?php			    
				 $sql = "SELECT max(app_req_no) as no FROM krk_applications WHERE YEAR(app_date) = YEAR(CURDATE());";
				 $stmt = $db->prepare($sql);
                 $stmt->execute();
                 $no = $stmt->fetch();
                 if ($no['no'] == ''){
                 	$req_no = '1';
                 } else {
                 	$req_no = $no['no']+1;
                 }
				?>
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
				<label for="jm">Luas Lahan</label>	    
				<input type="text" class="form-control" id="app_land_area" name="app_land_area" autocomplete="off" required> 
			</div> 
			<div class="form-group">
				<label for="jm">Luas Lahan Permohonan</label>	    
				<input type="text" class="form-control" id="app_proposed_land_area" name="app_proposed_land_area" autocomplete="off" required> 
			</div>   
			<div class="form-group">
				<label for="jm">No. Sertifikat</label>	    
				<input type="text" class="form-control" id="app_certificate_no" name="app_certificate_no" autocomplete="off" required> 
			</div>  
			<div class="form-group">
				<label for="jm">No. PL</label>	    
				<input type="text" class="form-control" id="app_pl_no" name="app_pl_no" autocomplete="off" required> 
			</div>  
			<div class="form-group">
				<label for="jm">No. IMB</label>	    
				<input type="text" class="form-control" id="app_imb_no" name="app_imb_no" autocomplete="off"> 
			</div>  
			<div class="form-group">
				<label for="jm">Peruntukan Lahan Perpres 87/2011</label>	    
				<input type="text" class="form-control" id="app_allotment_perpres" name="app_allotment_perpres" autocomplete="off"> 
			</div> 
			<div class="form-group">
				<label for="jm">Peruntukan Lahan Prov. Kepri 1/2017</label>	    
				<input type="text" class="form-control" id="app_allotment_prov" name="app_allotment_prov" autocomplete="off"> 
			</div> 
			<div class="form-group">
				<label for="jm">Peruntukan Bangunan</label>	    
				<input type="text" class="form-control" id="app_building_allotment" name="app_building_allotment" autocomplete="off"> 
			</div> 
			<div class="form-group">
				<input type="hidden" class="form-control" id="app_lat" name="app_lat" autocomplete="off" placeholder="Latitude" required> 
				<input type="hidden" class="form-control" id="app_long" name="app_long" autocomplete="off" placeholder="Longitude" required>
				<div class="pac-card" id="pac-card">
			      <br>
			      <div id="pac-container">
			        <input id="pac-input" type="text" placeholder="Masukkan Lokasi">
			      </div>
			    </div>
				<div id="map" style="width: auto; height: 300px"></div>
			</div>
			<div class="form-group">
				<label for="jm">KTP</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Peruntukan Lahan</label>	   
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
				<label for="jm">Bukti Lunas Pajak Bumi dan Bangunan (PBB)</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>
			<div class="form-group">
				<label for="jm">Surat izin bekerja perencana (SIBP)</label>	   
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
				<label for="jm">Izin Mendirikan Bangunan (IMB)</label>	   
				<input type="file" class="form-control" id="file" name="files[]" accept="application/pdf" required>
				<small>&nbsp;* file format PDF. Maximum upload file size 5Mb.</small>
			</div>	
			<div class="form-group">
				<label for="jm">Berkas Lainnya</label>	   
				<input type="file" class="form-control" id="file" name="files[]" multiple="multiple" accept="application/pdf">
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
  <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 1.128805, lng: 104.054823},
          mapTypeControl: true,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.TOP_RIGHT
          },
          zoomControl: true,
        
          scaleControl: true,
          streetViewControl: true,
      	  fullscreenControl: true
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          /*if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }*/

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);

          $("#app_lat").val(place.geometry.location.lat());
          $("#app_long").val(place.geometry.location.lng());
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        google.maps.event.addListener(map, 'click', function (e) {
          marker.setPosition(e.latLng);
          marker.setVisible(true);
          $("#app_lat").val(e.latLng.lat());
          $("#app_long").val(e.latLng.lng());
        });
      }
    </script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5dE6Rz99tbJzGSw5CaKIDXbT6Vvnzao&libraries=places&callback=initMap"
        async defer></script>