<<<<<<< HEAD
<?php

/**
* 
*/
class Customer extends DatabaseHelper
{
	
	public $tableName = "customer";
	public $id;
	public $user_id;
	public $person_id;
	public $deleted;
	public $company_id;


	public function delete($id){
		$sql = "DELETE FROM " . $this->tableName . " WHERE id='" . $id. "' ";
		$result = $this->exec($sql);
		 
		return $result;
	}

	
	
	public function getAllCustomer(){
		$sql = " SELECT DISTINCT company_id FROM  " . $this->tableName . " ORDER BY company_id 1";

		$result = $this->query($sql);

//		$company_id = [];

		while($row = $this->fetchRow($result)) {
			$ides[] = $row;
		}
		return $ides;
    }

    public function save(){
		$sql = "INSERT INTO " . $this->tableName. " (`user_id`, `person_id`, `deleted`, `company_id`) VALUES('" . $this->user_id . "','" . $this->person_id . "','" . $this->deleted . "','" . $this->company_id . "')";

		// var_dump($sql);
		// die;
		$result = $this->exec($sql);
		return $result;
	}

    public function getAllCompany(){
 		$sql = " SELECT DISTINCT company_id FROM  " . $this->tableName . " ORDER BY company_id ASC";

		$result = $this->query($sql);

		$companies = [];

	while($row = $this->fetchRow($result)) {
		$companies[] = $row;
 		}
		return $companies;
    }

}


=======
<?php 

class Customer extends DatabaseHelper{
		public $tableName = "customer";

		public $id;
		public $user_id;
		public $person_id;
		public $deleted;
		public $company_id;


		public function getCustomer($user_id)
        {

            $whrere = " WHERE user_id='". $user_id . "'";
            $m = new self();

            $m->findOne($whrere);
            
            return $m;
        }
}
>>>>>>> doanphp/master
