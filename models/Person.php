<?php

/**
* 
*/
class Person extends DatabaseHelper
{
	
	public $tableName = "person";
	public $id;
	public $firstname;
	public $middlename;
	public $lastname;
	public $gender;
	public $birthdate;
	public $email;
	public $phone_number;
	public $ssn;


	public function getPerson($id)
    {
            $whrere = " WHERE id='". $id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
    }



	public function getAllPerson(){
		$sql = " SELECT DISTINCT id FROM  " . $this->tableName . " ORDER BY id 1";

		$result = $this->query($sql);

		$genderes = [];

		while($row = $this->fetchRow($result)) {
			$genderes[] = $row;
		}		
		return $genderes;
	}
}