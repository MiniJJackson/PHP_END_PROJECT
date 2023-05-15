<?php

class User{
        private $username;
        private $email;
        private $password;

        

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
            if(empty($username)){
                throw new Exception("Username can't be empty");
            }
            $this->username = $username;

                return $this;
        }

        /** met een getter willen we eerst informatie krijgen, een setter zal dan de informatie "setten" in het huidig object (= $this) */

        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 

        public function setLastname($lastname)
        {
            if(empty($lastname)){
                throw new Exception("Lastname can't be empty");
            }
            $this->lastname = $lastname;

                return $this;
        }

        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 

        public function setFirstname($firstname)
        {
            if(empty($firstname)){
                throw new Exception("Firstname can't be empty");
            }
            $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function save(){
            // conn
            //$conn = Db::getConnection();
            $conn = new PDO('mysql:host=127.0.0.1;dbname=phptest',"root", "");
            // insert query
            
            $statement = $conn->prepare("insert into gebruikers(`user_id`, `username`, `password`, `firstname`, `lastname`, `email`) values (:user_id, :username, :password, :firstname, :lastname, :email)");
            // return result

            $statement->bindValue(":user_id", uniqid());
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":password", $this->password);

            $result = $statement->execute();
            return $result;

        }
}
?>