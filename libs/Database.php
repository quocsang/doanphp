<?php 
class Database{

	protected $dbconn;
	private $host; 
	private $user;
	private $pass;
	private $dbname;

	public function __construct($config){
 
			$this->host = $config["host"];
			$this->user = $config['user'];
			$this->pass = $config["pass"];
			$this->dbname = $config["dbname"];

			$this->connect();
	}

	public function connect(){
		
		if (! $this->dbconn) {

			$this->dbconn = mysqli_connect($this->host, $this->user,$this->pass,$this->dbname);
			if (!$this->dbconn) {
				echo "Lỗi: " . mysqli_connect_eror();
				die; 
			}

			mysqli_set_charset($this->dbconn, "utf8");
		}
	}

	public function query($sql){

		$resutl= mysqli_query($this->dbconn, $sql);

		if (mysqli_error($this->dbconn)){
			echo "Lỗi: " . mysqli_error($this->dbconn);
			return null;
		}else{

			return $resutl;
		}
	}

	public function exec($sql){
		$result = $this->query($sql);

		if (mysqli_error($this->dbconn)){
		//	echo "Lỗi: " . mysqli_error($this->dbconn);
			return false;
		}else{

			return mysqli_affected_rows($this->dbconn);
		}
	}
	  
	public function fetchRow($result){
		return mysqli_fetch_assoc($result);
	}
}