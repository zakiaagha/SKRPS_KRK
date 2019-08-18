<?php
class Application{
	
	private $conn;
	private $table_name = "krk_applications";
	
	public $id;
	public $app_name;
	public $app_address;
	public $app_nik;
	public $app_date;
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
	
	public function __construct($db){
		$this->conn = $db;
	}

	function insert(){
		$query = "insert into ".$this->table_name." (app_name, app_address, app_nik, app_owner_name, app_owner_address) values(?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_address);
		$stmt->bindParam(3, $this->app_nik);
		$stmt->bindParam(4, $this->app_owner_name);
		$stmt->bindParam(5, $this->app_owner_address);
		
		if($stmt->execute()){
			return true;
		}else{
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