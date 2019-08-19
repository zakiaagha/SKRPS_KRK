<?php
class User{
	
	private $conn;
    private $table_name = "krk_users";
    private $table_role = "krk_role_detail";
	
	public $id;
	public $user_name;
	public $user_full_name;
	public $user_password;
	public $user_email;
	public $user_nip;
	public $user_address;
    public $user_telpon;
    public $user_role;
    public $rd_user_id;	
    public $datenow;
    public $uid;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){

		$query = "insert into ".$this->table_name." (user_name, user_full_name, user_password, user_email, user_nip, user_address, user_telpon, user_cr_uid, user_cr_dt) values(?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->user_name);
		$stmt->bindParam(2, $this->user_full_name);
		$stmt->bindParam(3, $this->user_password);
		$stmt->bindParam(4, $this->user_email);
		$stmt->bindParam(5, $this->user_nip);
		$stmt->bindParam(6, $this->user_address);
        $stmt->bindParam(7, $this->user_telpon);
        $stmt->bindParam(8, $this->uid);
        $stmt->bindParam(9, $this->datenow);
		if($stmt->execute()){
			$this->rd_user_id = $this->conn->lastInsertId();
        	$this->insertRole();
			return true;
		}else{
			return false;
        }
		
	}
	
	
	function insertRole(){
		$query = "insert into krk_role_detail (rd_user_id, rd_role_id) VALUES(?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->rd_user_id);
		$stmt->bindParam(2, $this->user_role);
		if($stmt->execute()){
			return true;
		}else{
			return false;
        }		
	}

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