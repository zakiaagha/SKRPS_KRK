<?php
include_once 'header.php';
if($_POST){
	
	include_once 'includes/pemohon.inc.php';
	$eks = new Pemohon($db);

	$eks->nama_pemohon = $_POST['nama_pemohon'];
	$eks->alamat_pemohon = $_POST['alamat_pemohon'];
	$eks->nama_pemilik = $_POST['nama_pemilik'];
	$eks->alamat_lokasi = $_POST['alamat_lokasi'];
	$eks->no_pl = $_POST['no_pl'];
	$eks->no_sertifikat = $_POST['no_sertifikat'];
	$eks->luas_lahan = $_POST['luas_lahan'];
	$eks->peruntukan_lahan = $_POST['peruntukan_lahan'];
	$eks->peruntukan_bangunan = $_POST['peruntukan_bangunan'];
	$eks->ketinggian_maksimum = $_POST['ketinggian_maksimum'];
	$eks->jumlah_lantai = $_POST['jumlah_lantai'];
	$eks->gsbdm = $_POST['gsbdm'];
	$eks->gsbskn = $_POST['gsbskn'];
	$eks->gsbskr = $_POST['gsbskr'];
	$eks->gsbblk = $_POST['gsbblk'];
	$eks->kdb = $_POST['kdb'];
	$eks->klb = $_POST['klb'];
	$eks->kdh = $_POST['kdh'];
	$eks->ktb = $_POST['ktb'];
	$eks->utilitas = $_POST['utilitas'];
	$eks->inform = $_POST['inform'];
	$eks->bln = date('m');
	$eks->year = date('Y');
	
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
		<div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">
		  <div class="well">			
			    <form method="post">
				  <div class="form-group">
				    <label for="tp">Nama Pemohon</label>
				    <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
				  </div>
				  <div class="form-group">
				    <label for="jm">Alamat Pemohon</label>			
				    <textarea type="text" class="form-control" id="alamat_pemohon" name="alamat_pemohon" required></textarea>	    
				  </div>
				  <div class="form-group">
				    <label for="jm">Nama Pemilik Lahan</label>				    
				    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
				  </div>
				  <div class="form-group">
				    <label for="jm">Alamat Lokasi</label>				    
				    <textarea type="text" class="form-control" id="alamat_lokasi" name="alamat_lokasi" required></textarea>	    
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

				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='index.php'" class="btn btn-success">Kembali</button>
		  </div>
		  </div>
		  <div class="col-xs-12 col-sm-6 col-md-6">
		  <div class="well">
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
				</form>
			  
		  </div>
		  </div>
		<?php
?>