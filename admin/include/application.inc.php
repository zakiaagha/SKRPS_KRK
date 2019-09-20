<?php
class Application{
	
	private $conn;
	private $table_name = "krk_applications";
	private $table_attach = "krk_applications_attachment";
	private $table_image = "krk_applications_image";
	
	public $id;
	public $app_id;
	public $app_name;
	public $app_no;
	public $app_req_no;
	public $app_address;
	public $app_nik;
	public $app_date;
	public $app_end_date;
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
		$query = "insert into ".$this->table_name." (app_name, app_nik, app_address, app_telepon, app_owner_name, app_owner_address, app_land_area, app_proposed_land_area, app_certificate_no, app_pl_no, app_allotment_perpres, app_allotment_prov, app_building_allotment, app_imb_no, app_date, app_lat, app_long, app_cr_uid, app_cr_dt, app_comment, app_req_no, app_status) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_nik);
		$stmt->bindParam(3, $this->app_address);
		$stmt->bindParam(4, $this->app_telepon);
		$stmt->bindParam(5, $this->app_owner_name);
		$stmt->bindParam(6, $this->app_owner_address);
		$stmt->bindParam(7, $this->app_land_area);
		$stmt->bindParam(8, $this->app_proposed_land_area);
		$stmt->bindParam(9, $this->app_certificate_no);
		$stmt->bindParam(10, $this->app_pl_no);
		$stmt->bindParam(11, $this->app_allotment_perpres);
		$stmt->bindParam(12, $this->app_allotment_prov);
		$stmt->bindParam(13, $this->app_building_allotment);
		$stmt->bindParam(14, $this->app_imb_no);
		$stmt->bindParam(15, $this->app_date);
		$stmt->bindParam(16, $this->app_lat);
		$stmt->bindParam(17, $this->app_long);
		$stmt->bindParam(18, $this->app_name);
		$stmt->bindParam(19, $this->datenow);
		$stmt->bindParam(20, $this->app_comment);
		$stmt->bindParam(21, $this->app_req_no);
		$stmt->bindParam(22, $this->app_status);
		
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

    function readByNikNo(){
		$query = "SELECT * FROM ".$this->table_name." WHERE app_nik=? AND app_req_no=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_nik);
		$stmt->bindParam(2, $this->app_req_no);
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
		$this->app_no = $row['app_no'];
		$this->app_req_no = $row['app_req_no'];
		$this->app_end_date = $row['app_end_date'];
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
		$query = "UPDATE ".$this->table_name."
				  SET app_name=?, app_address=?, app_owner_name=?, app_owner_address=?, app_certificate_no=?, app_pl_no=?, app_imb_no=?, app_allotment_perpres=?, app_allotment_prov=?, app_building_allotment=?,app_max_building_height=?, app_no_of_floors=?,app_min_gsb_front=?, app_min_gsb_right_side=?,app_min_gsb_left_side=?, app_min_gsb_back=?,app_min_gsp=?, app_max_kdb=?, app_max_klb=?, app_min_kdh=?,  app_max_ktb=?,  app_row=?, app_land_area=?, app_proposed_land_area=?, app_upd_uid=?, app_upd_dt=?
				  WHERE idm_application = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_address);
		$stmt->bindParam(3, $this->app_owner_name);
		$stmt->bindParam(4, $this->app_owner_address);
		$stmt->bindParam(5, $this->app_certificate_no);
		$stmt->bindParam(6, $this->app_pl_no);
		$stmt->bindParam(7, $this->app_imb_no);
		$stmt->bindParam(8, $this->app_allotment_perpres);
		$stmt->bindParam(9, $this->app_allotment_prov);
		$stmt->bindParam(10, $this->app_building_allotment);
		$stmt->bindParam(11, $this->app_max_building_height);
		$stmt->bindParam(12, $this->app_no_of_floors);
		$stmt->bindParam(13, $this->app_min_gsb_front);
		$stmt->bindParam(14, $this->app_min_gsb_right_side);
		$stmt->bindParam(15, $this->app_min_gsb_left_side);
		$stmt->bindParam(16, $this->app_min_gsb_back);
		$stmt->bindParam(17, $this->app_min_gsp);
		$stmt->bindParam(18, $this->app_max_kdb);
		$stmt->bindParam(19, $this->app_max_klb);
		$stmt->bindParam(20, $this->app_min_kdh);
		$stmt->bindParam(21, $this->app_max_ktb);
		$stmt->bindParam(22, $this->app_row);
		$stmt->bindParam(23, $this->app_land_area);
		$stmt->bindParam(24, $this->app_proposed_land_area);
		$stmt->bindParam(25, $this->uid);
		$stmt->bindParam(26, $this->datenow);
		$stmt->bindParam(27, $this->app_id);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }

    function update2(){
		$query = "UPDATE ".$this->table_name."
				  SET app_name=?, app_nik=?, app_address=?, app_telepon=?, app_owner_name=?, app_owner_address=?, app_land_area=?, app_proposed_land_area=?, app_certificate_no=?, app_pl_no=?, app_imb_no=?, app_allotment_perpres=?, app_allotment_prov=?, app_building_allotment=?, app_lat=?, app_long=?, app_status='', app_comment='Berkas sudah dilengkapi oleh pemohon', app_upd_uid=?, app_upd_dt=?
				  WHERE idm_application = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_name);
		$stmt->bindParam(2, $this->app_nik);
		$stmt->bindParam(3, $this->app_address);
		$stmt->bindParam(4, $this->app_telepon);
		$stmt->bindParam(5, $this->app_owner_name);
		$stmt->bindParam(6, $this->app_owner_address);
		$stmt->bindParam(7, $this->app_land_area);
		$stmt->bindParam(8, $this->app_proposed_land_area);
		$stmt->bindParam(9, $this->app_certificate_no);
		$stmt->bindParam(10, $this->app_pl_no);
		$stmt->bindParam(11, $this->app_imb_no);
		$stmt->bindParam(12, $this->app_allotment_perpres);
		$stmt->bindParam(13, $this->app_allotment_prov);
		$stmt->bindParam(14, $this->app_building_allotment);
		$stmt->bindParam(15, $this->app_lat);
		$stmt->bindParam(16, $this->app_long);
		$stmt->bindParam(17, $this->uid);
		$stmt->bindParam(18, $this->datenow);
		$stmt->bindParam(19, $this->app_id);
		
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

    function updateStatus2(){
		$query = "UPDATE ".$this->table_name."
				  SET app_status=?, app_comment=?, app_end_date=?, app_no=?, app_upd_uid=?, app_upd_dt=?
				  WHERE idm_application = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->app_status);
		$stmt->bindParam(2, $this->app_comment);
		$stmt->bindParam(3, $this->app_end_date);
		$stmt->bindParam(4, $this->app_no);
		$stmt->bindParam(5, $this->uid);
		$stmt->bindParam(6, $this->datenow);
		$stmt->bindParam(7, $this->app_id);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }
}
?>