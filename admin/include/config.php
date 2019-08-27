
<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
ob_start();

date_default_timezone_set("Asia/Bangkok");
class Config{
	
	private $host = "localhost";
	private $db_name = "krk";
	private $username = "root";
	private $password = "";
	public $conn;
	
	public function getConnection(){
	
		$this->conn = null;
		
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		
		return $this->conn;
	}


}

require_once 'functions.php';

if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "" ) {
    $ERROR_TYPE = $_SESSION["errorType"];
    $ERROR_MSG = $_SESSION["errorMsg"];
    $_SESSION["errorType"] = "";
    $_SESSION["errorMsg"] = "";
}
?>
