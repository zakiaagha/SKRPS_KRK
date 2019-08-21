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
		$query = "SELECT * FROM ".$this->table_name." LEFT JOIN ".$this->table_role." ON rd_user_id=idm_user LEFT JOIN krk_roles ON idm_role=rd_role_id WHERE md5(idm_user)=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idm_user'];
		$this->user_name = $row['user_name'];
		$this->user_full_name = $row['user_full_name'];
		$this->user_password = $row['user_password'];
		$this->user_email = $row['user_email'];
		$this->user_nip = $row['user_nip'];
		$this->user_address = $row['user_address'];
	    $this->user_telpon = $row['user_telpon'];
	    $this->user_role = $row['rd_role_id'];
	}

	function update(){
		$query = "UPDATE ".$this->table_name."
				  SET user_name=?, user_full_name=?, user_password=?, user_email=?, user_nip=?, user_address=?, user_telpon=?, user_upd_uid=?, user_upd_dt=?
				  WHERE md5(idm_user) = ?";
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
		$stmt->bindParam(10, $this->id);

		if($stmt->execute()){
        	$this->updateRole();
			return true;
		}else{
			return false;
		}
		
	}

	function updateRole(){
		$query = "UPDATE ".$this->table_role."
				  SET rd_role_id=?, rd_upd_uid=?, rd_upd_dt=?
				  WHERE md5(rd_user_id) = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->user_role);
		$stmt->bindParam(2, $this->uid);
		$stmt->bindParam(3, $this->datenow);
		$stmt->bindParam(4, $this->id);
		if($stmt->execute()){
			return true;
		}else{
			return false;
        }		
	}

	function deleteOne(){
		$query = "DELETE FROM " . $this->table_name . " WHERE idm_user=?";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		return $stmt;
    }
    
	
}
?>