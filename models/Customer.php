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