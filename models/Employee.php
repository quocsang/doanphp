<?php 

class Employee extends DatabaseHelper{
		public $tableName = "employee";

		public $id;
		public $user_id;
		public $person_id;
		public $employee_type;


		public function getEmployee($user_id)
        {
            $whrere = " WHERE user_id='". $user_id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }
}