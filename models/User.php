<?php 

class User extends DatabaseHelper{
		public $tableName = "user";

		public $id;
		public $group;
		public $username;
		public $password_hash;
		public $avatar;


		public function getUser($username)
        {
            $whrere = " WHERE username='". $username . "'";
            $m = new self();
            $m->findOne($whrere);
            return $m;
        }


        public function authenticate($password)
        {
            if ($this->id != ""){
                return password_verify($password, $this->password_hash );
            }

            return false;
        }

        public function updatePass($newpass){
            $sql = "UPDATE " . $this->tableName . " SET 
                                                        `password_hash` = '" . password_hash($newpass, PASSWORD_DEFAULT) . "'
                                                        
                                                    WHERE `" . $this->tableName . "`.`id` =" . $this->id ;

            $result = $this->exec($sql);
            $this->password_hash = password_hash($newpass, PASSWORD_DEFAULT);
            return $result;
        }

}