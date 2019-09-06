<?php
class Application{
	
	private $conn;
	private $table_name = "krk_applications";
	private $table_attach = "krk_applications_attachment";
	private $table_image = "krk_applications_image";
	
	public $id;
	public $app_id;
	public $app_name;
	public $app_address;
	public $app_nik;
	public $app_date;
	public $app_telepon;
	public $app_lat;
	public $app_long;
	public $app_owner_name;
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
	public $app_max_ktb; 
	public $app_row; 
	public $app_status; 
	public $app_comment; 
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
		$query = "insert into ".$this->table_name." (app_name, app_nik, app_address, app_telepon, app_owner_name, app_owner_address, app_land_area, app_date, app_lat, app_long, app_cr_uid, app_cr_dt) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_nik);
		$stmt->bindParam(3, $this->app_address);
		$stmt->bindParam(4, $this->app_telepon);
		$stmt->bindParam(5, $this->app_owner_name);
		$stmt->bindParam(6, $this->app_owner_address);
		$stmt->bindParam(7, $this->app_land_area);
		$stmt->bindParam(8, $this->app_date);
		$stmt->bindParam(9, $this->app_lat);
		$stmt->bindParam(10, $this->app_long);
		$stmt->bindParam(11, $this->app_name);
		$stmt->bindParam(12, $this->datenow);
		
		if($stmt->execute()){
			$this->app_id = $this->conn->lastInsertId();
			return $this->app_id;
		} else {
			return false;
		}
	}

	function insertImage(){
		$query = "insert into ".$this->table_image." (app_image_id, app_image_seq, app_image_name, app_image_type, app_image_cr_uid, app_image_cr_dt) values(?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_id);
		$stmt->bindParam(2, $this->app_seq_file);
		$stmt->bindParam(3, $this->app_file_name);
		$stmt->bindParam(4, $this->app_file_type);
		$stmt->bindParam(5, $this->uid);
		$stmt->bindParam(6, $this->datenow);
		
		if($stmt->execute()){
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
		$stmt->bindParam(5, $this->app_name);
		$stmt->bindParam(6, $this->datenow);
		
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

    function readByNik(){
		$query = "SELECT * FROM ".$this->table_name." WHERE app_nik=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_nik);
		$stmt->execute();
        
        return $stmt;
    }

    function readOne(){		
		$query = "SELECT * FROM ".$this->table_name." WHERE md5(idm_application)=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->app_id = $row['idm_application'];
		$this->app_name = $row['app_name'];
		$this->app_address = $row['app_address'];
		$this->app_nik = $row['app_nik'];
		$this->app_date = $row['app_date'];
		$this->app_telepon = $row['app_telepon'];
		$this->app_lat = $row['app_lat'];
		$this->app_long = $row['app_long'];
		$this->app_owner_name = $row['app_owner_name'];
		$this->app_owner_address = $row['app_owner_address'];
		$this->app_certificate_no = $row['app_certificate_no'];
		$this->app_pl_no = $row['app_pl_no'];
		$this->app_land_area = $row['app_land_area'];
		$this->app_proposed_land_area = $row['app_proposed_land_area'];
		$this->app_allotment_perpres = $row['app_allotment_perpres'];
		$this->app_allotment_prov = $row['app_allotment_prov'];
		$this->app_building_allotment = $row['app_building_allotment'];
		$this->app_imb_no = $row['app_imb_no'];
		$this->app_max_building_height = $row['app_max_building_height'];
		$this->app_no_of_floors = $row['app_no_of_floors'];
		$this->app_min_gsb_front = $row['app_min_gsb_front'];
		$this->app_min_gsb_right_side = $row['app_min_gsb_right_side'];
		$this->app_min_gsb_left_side = $row['app_min_gsb_left_side'];
		$this->app_min_gsb_back = $row['app_min_gsb_back'];
		$this->app_min_gsp = $row['app_min_gsp'];
		$this->app_max_kdb = $row['app_max_kdb']; 
		$this->app_max_klb = $row['app_max_klb']; 
		$this->app_min_kdh = $row['app_min_kdh']; 
		$this->app_max_ktb = $row['app_max_ktb']; 
		$this->app_row = $row['app_row']; 
		$this->pp_status = $row['app_status']; 
		$this->app_comment = $row['app_comment'];
	}

	function readAttachment(){		
		$query = "SELECT * FROM ".$this->table_attach." WHERE md5(app_attach_id)=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		return $stmt;
	}

	function readImage(){		
		$query = "SELECT * FROM ".$this->table_image." WHERE md5(app_image_id)=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		return $stmt;
	}

    function update(){
    	
	$app->app_certificate_no=$_POST['app_certificate_no'];
	$app->app_pl_no=$_POST['app_pl_no'];
	$app->app_imb_no=$_POST['app_imb_no'];
	$app->app_allotment_perpres=$_POST['app_allotment_perpres'];
	$app->app_allotment_prov=$_POST['app_allotment_prov'];
	$app->app_building_allotment=$_POST['app_building_allotment'];
	$app->app_max_building_height=$_POST['app_max_building_height'];
	$app->app_no_of_floors=$_POST['app_no_of_floors'];
	$app->app_min_gsb_front=$_POST['app_min_gsb_front'];
	$app->app_min_gsb_right_side=$_POST['app_min_gsb_right_side'];
	$app->app_min_gsb_left_side=$_POST['app_min_gsb_left_side'];
	$app->app_min_gsb_back=$_POST['app_min_gsb_back'];
	$app->app_min_gsp=$_POST['app_min_gsp'];
	$app->app_max_kdb=$_POST['app_max_kdb'];
	$app->app_max_klb=$_POST['app_max_klb'];
	$app->app_min_kdh=$_POST['app_min_kdh'];
	$app->app_max_ktb=$_POST['app_max_ktb'];
	$app->app_row=$_POST['app_row'];
	$app->uid=$_SESSION['user_name'];
	$app->datenow=date("Y-m-d H:i:s");
		$query = "UPDATE ".$this->table_name."
				  SET app_status=?, app_comment=?, app_upd_uid=?, app_upd_dt=?
				  WHERE idm_application = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_status);
		$stmt->bindParam(2, $this->app_comment);
		$stmt->bindParam(3, $this->uid);
		$stmt->bindParam(4, $this->datenow);
		$stmt->bindParam(5, $this->app_id);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }

    function updateStatus(){
		$query = "UPDATE ".$this->table_name."
				  SET app_status=?, app_comment=?, app_upd_uid=?, app_upd_dt=?
				  WHERE idm_application = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_status);
		$stmt->bindParam(2, $this->app_comment);
		$stmt->bindParam(3, $this->uid);
		$stmt->bindParam(4, $this->datenow);
		$stmt->bindParam(5, $this->app_id);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }
}
?>