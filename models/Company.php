<<<<<<< HEAD
<?php

	/**
	* 
	*/
class Company extends DatabaseHelper
{
		
		public $tableName =  "company";
		public $id ;
		public $company;
		public $address_id;
		public $website;


		public function getCompany($id)
        {
            $whrere = " WHERE id='". $id . "'";
            $m = new Company();
            $m->findOne($whrere);
            return $m;
    	}
    	public function getAllCompany(){
 		$sql = " SELECT DISTINCT id FROM  " . $this->tableName . " ORDER BY id ASC";

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

class Company extends DatabaseHelper{
		public $tableName = "company";

		public $id;
		public $company;
		public $address_id;
		public $website;


		public function getCompany($id)
        {
            $whrere = " WHERE id='". $id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }
}
>>>>>>> doanphp/master
