<?php
class Application{
	
	private $conn;
	private $table_name = "krk_applications";
	
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
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
}
?>