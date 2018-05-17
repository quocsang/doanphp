<?php 

class DatabaseHelper{
	public $db;
	public $tableName;

	public function __construct(){
		$this->init();
	}

	private function init(){
		$this->db = isset($GLOBALS['db'])?$GLOBALS['db']:null;
	}

	public function query($sql){

		return $this->db->query($sql);

	}

	public function exec($sql){
		return $this->db->exec($sql);
	}

	public function fetchRow($result){
		return $this->db->fetchRow($result);
	}

	public function findOne($where =null){
		$sql = "SELECT * FROM " . $this->tableName ;
		$sql .= " " . $where  ;

		$result = $this->query($sql);
		$row = $this->fetchRow($result);

		if ($row){				
			$this->load($row);
		}

	}

	public function findAll($where =null){

		$sql = "SELECT * FROM " . $this->tableName ;
		$sql .= " " . $where  ;
		$result = $this->query($sql);

		$models = [];

		while($row = $this->fetchRow($result)) {
			$class = get_called_class(); // Airport; User, ....
			$model = new $class();			
			
			$model->load($row);

			$models[] = $model;
		}

		return $models;
			
	}

	

	public function load($data){

			if (is_array($data)){
				// ["code" => "AAA", 'name' => "ABC", 'city' => 'NY', 'state' => 'Wasington', 'country' => "US"]
				$class = get_called_class(); // Airport; User,...
				$classObject = new $class();
				 
				$attributes = get_object_vars($classObject);
				
				foreach($data as $atrr => $val){
					if (array_key_exists($atrr, $attributes)){
						$this->$atrr = $val;
					}
				}
			}

	}

}