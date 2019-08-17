<?php
class Application{
	
	private $conn;
	private $table_name = "application";
	
	public $id;
	public $nama_pemohon;
	public $alamat_pemohon;
	public $nama_pemilik;
	public $alamat_lokasi;
	public $no_pl;
	public $no_sertifikat;
	public $luas_lahan;
	public $peruntukan_lahan;
	public $peruntukan_bangunan;
	public $ketinggian_maksimum;
	public $jumlah_lantai;
	public $gsbdm;
	public $gsbskn;
	public $gsbskr;
	public $gsbblk;
	public $kdb;
	public $klb;
	public $kdh;
	public $ktb;
	public $utilitas;
	public $inform;
	public $bln; 
	public $year; 	
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_name." values('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nama_pemohon);
		$stmt->bindParam(2, $this->alamat_pemohon);
		$stmt->bindParam(3, $this->bln);
		$stmt->bindParam(4, $this->year);
		$stmt->bindParam(5, $this->nama_pemilik);
		$stmt->bindParam(6, $this->alamat_lokasi);
		$stmt->bindParam(7, $this->no_pl);
		$stmt->bindParam(8, $this->no_sertifikat);
		$stmt->bindParam(9, $this->luas_lahan);
		$stmt->bindParam(10, $this->peruntukan_lahan);
		$stmt->bindParam(11, $this->peruntukan_bangunan);
		$stmt->bindParam(12, $this->ketinggian_maksimum);
		$stmt->bindParam(13, $this->jumlah_lantai);
		$stmt->bindParam(14, $this->gsbdm);
		$stmt->bindParam(15, $this->gsbskn);
		$stmt->bindParam(16, $this->gsbskr);
		$stmt->bindParam(17, $this->gsbblk);
		$stmt->bindParam(18, $this->kdb);
		$stmt->bindParam(19, $this->klb);
		$stmt->bindParam(20, $this->kdb);
		$stmt->bindParam(21, $this->ktb);
		$stmt->bindParam(22, $this->utilitas);
		$stmt->bindParam(23, $this->inform);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_data ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_data=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_data'];
		$this->nama_pemohon = $row['nama_pemohon'];
		$this->alamat_pemohon = $row['alamat_pemohon'];
		$this->bln = $row['bulan'];
		$this->year = $row['tahun'];
		$this->nama_pemilik = $row['pemilik_tanah'];
		$this->alamat_lokasi = $row['alamat_lokasi'];
		$this->no_pl = $row['no_pl'];
		$this->no_sertifikat = $row['no_sertifikat'];
		$this->luas_lahan = $row['luas_lahan'];
		$this->peruntukan_lahan = $row['peruntukan_lahan'];
		$this->peruntukan_bangunan = $row['peruntukan_bangunan'];
		$this->ketinggian_maksimum = $row['ketinggian_mak'];
		$this->jumlah_lantai = $row['jml_lantai'];
		$this->gsbdm = $row['gsbdm'];
		$this->gsbskn = $row['gsbskn'];
		$this->gsbskr = $row['gsbskr'];
		$this->gsbblk = $row['gsbblk'];
		$this->kdb = $row['kdb'];
		$this->klb = $row['klb'];
		$this->kdh = $row['kdh'];
		$this->ktb = $row['ktb'];
		$this->utilitas = $row['jaringan_utilitas'];
		$this->inform = $row['inform_lainnya'];
	}
	function deleteOne(){
		$query = "DELETE FROM " . $this->table_name . " WHERE id_data=?";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		return $stmt;
	}
	
}
?>