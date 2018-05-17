<?php 

class Person extends DatabaseHelper{
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
		public $created_at;
		public $updated_at;



		public function getPerson($id)
        {
            $whrere = " WHERE id='". $id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }

        public function createPerson(){
        	$sql = "INSERT INTO " . $this->tableName. " 
        							(firstname, middlename, lastname, gender, birthdate, email, phone_number, ssn) 
        					VALUES(
        						'" . $this->firstname . "',
        						'" . $this->middlename . "',
        						'" . $this->lastname . "',
        						'" . $this->gender . "',
        						'" . $this->birthdate . "',
        						'" . $this->email . "',
        						'" . $this->phone_number . "',
        						'" . $this->ssn . "')";

			$result = $this->exec($sql);
			return $result;
        }
        public function updatePerson(){
        	$sql = "UPDATE " . $this->tableName . " SET 
        												`firstname` = '" . $this->firstname . "',
        												`middlename` = '" . $this->middlename . "' , 
        												`lastname` = '" . $this->lastname . "' , 
        												`gender` = '" . $this->gender . "' , 
	        											`birthdate` = '" . $this->birthdate . "' , 
	        											`email` = '" . $this->email . "' , 
	        											`phone_number` = '" . $this->phone_number . "' , 
	        											`ssn` = '" . $this->ssn . "' , 
	        											`updated_at` = now()
	        										WHERE `" . $this->tableName . "`.`id` = " . $this->id ;

			$result = $this->exec($sql);
			return $result;
        }
}