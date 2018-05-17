<?php 

 

class Airport extends DatabaseHelper{
		public $tableName = "airport";
		public $code;
		public $name;
		public $city;
		public $state;
		public $country;

	public function getAllCountry(){
		$sql = " SELECT DISTINCT country FROM  " . $this->tableName . " ORDER BY country ASC";

		$result = $this->query($sql);

		$countries = [];

		while($row = $this->fetchRow($result)) {
			$countries[] = $row;
		}

		return $countries;
	}

	public function delete($code){
		$sql = "DELETE FROM " . $this->tableName . " WHERE code='" . $code. "' ";
		$result = $this->exec($sql);
		 
		return $result;
	}

	public function save(){
		$sql = "INSERT INTO " . $this->tableName. " (code, name, city, country, state) VALUES('" . $this->code . "','" . $this->name . "','" . $this->city . "','" . $this->country . "','" . $this->state . "')";

		$result = $this->exec($sql);
		return $result;
	}
}