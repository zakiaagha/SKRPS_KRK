<?php
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
    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </section><!-- #about -->



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