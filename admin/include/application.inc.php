<?php
class Application{
	
	private $conn;
	private $table_name = "krk_applications";
	private $table_attach = "krk_applications_attachment";
	
	public $app_id;
	public $app_name;
	public $app_address;
	public $app_nik;
	public $app_date;
	public $app_telepon;
	public $app_owner_name	;
	public $app_owner_address;
	public $app_certificate_no;
	public $app_pl_no;
	public $app_land_area;
	public $app_proposed_land_area;
	public $app_allotment_perpres;
	public $app_allotment_prov;
	public $app_building_allotment;
	public $app_imb_no;
	public $app_max_building_height;
	public $app_no_of_floors;
	public $app_min_gsb_front;
	public $app_min_gsb_right_side;
	public $app_min_gsb_left_side;
	public $app_min_gsb_back;
	public $app_min_gsp;
	public $app_max_kdb; 
	public $app_max_klb; 
	public $app_min_kdh; 
	public $app_min_ktb; 
	public $app_row; 
	public $app_file_temp; 
	public $app_file_name; 
	public $app_file_size; 
	public $app_file_type; 
	public $app_seq_file; 
	public $uid;
	public $datenow;
	
	public function __construct($db){
		$this->conn = $db;
	}

	function insert(){
		$query = "insert into ".$this->table_name." (app_name, app_nik, app_address, app_telepon, app_owner_name, app_owner_address, app_land_area, app_date) values(?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_nik);
		$stmt->bindParam(3, $this->app_address);
		$stmt->bindParam(4, $this->app_telepon);
		$stmt->bindParam(5, $this->app_owner_name);
		$stmt->bindParam(6, $this->app_owner_address);
		$stmt->bindParam(7, $this->app_land_area);
		$stmt->bindParam(8, date('Y-m-d'));
		
		if($stmt->execute()){
			$this->app_id = $this->conn->lastInsertId();
			return true;
		} else {
			return false;
		}
		
	}

	function insertAttachment(){
		$query = "insert into ".$this->table_attach." (app_attach_id, app_attach_seq, app_attach_name, app_attach_type, app_attach_cr_uid, app_attach_cr_dt) values(?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_id);
		$stmt->bindParam(2, $this->app_seq_file);
		$stmt->bindParam(3, $this->app_file_name);
		$stmt->bindParam(4, $this->app_file_type);
		$stmt->bindParam(5, $_SESSION['username']);
		$stmt->bindParam(6, date("Y-m-d H:i:s"));
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
		
	}
	
	function readAll(){
		$query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }
}
?>