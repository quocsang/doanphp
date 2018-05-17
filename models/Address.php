<?php 

class Address extends DatabaseHelper{
		public $tableName = "address";

		public $id;
		public $person_id;
		public $house_number;
		public $street;
		public $ward_id;
		public $district_id;
		public $province_id;
		public $phone;
		public $created_at;
		public $is_current;
		public $deleted;



		public function getAddressWhithId($id)
        {
            $whrere = " WHERE id='". $id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }

        public function getAddressWhithPersion($person_id)
        {
            $whrere = " WHERE person_id='". $person_id . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }
}