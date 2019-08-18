<?php 
class Login
{
	private $conn;
	private $table_name = "krk_users";
    private $table_level = "krk_role_detail";
	
    public $user;
    public $userid;
    public $passid;

    public function __construct($db){
		$this->conn = $db;
	}

    public function login()
    {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['user_full_name'] = $user['user_full_name'];
            $_SESSION['idm_user'] = $user['idm_user'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role_id'] = $user['rd_role_id'];
            return $user['user_full_name'];
        }
        return false;
    }

    protected function checkCredentials()
    {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.' 
                LEFT JOIN '.$this->table_level.' ON idm_user=rd_user_id 
                WHERE user_name=? and user_password=? and user_frz_flag_num');
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->passid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;
            return $data;
        }
        return false;
    }

    function readAll(){

        $query = 'SELECT * FROM '.$this->table_name.' 
                  LEFT JOIN '.$this->table_level.' ON rd_user_id=idm_user
                  LEFT JOIN krk_roles ON idm_role=rd_role_id';
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }

    public function getUser()
    {
        return $this->user;
    }
}
?>
