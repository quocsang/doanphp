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