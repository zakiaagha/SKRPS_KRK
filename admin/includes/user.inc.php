<?php
class User{
	
	private $conn;
	private $table_name = "krk_users";
	
	public $id;
	public $user_name;
	public $user_full_name;
	public $user_password;
	public $user_email;
	public $user_nip;
	public $user_address;
    public $user_telpon;
    public $user_role;	
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_name." (user_name, user_full_name, user_password, user_email, user_nip, user_address, user_telpon) values(?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->user_name);
		$stmt->bindParam(2, $this->user_full_name);
		$stmt->bindParam(3, $this->user_password);
		$stmt->bindParam(4, $this->user_email);
		$stmt->bindParam(5, $this->user_nip);
		$stmt->bindParam(6, $this->user_address);
        $stmt->bindParam(7, $this->user_telpon);
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