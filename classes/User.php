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
            $conn = new PDO('mysql:host=127.0.0.1;dbname=phpendproject',"root", "root");
            // insert query
            $statement = $conn->prepare("insert into users(`userName`, `email`, `password`) values (:username, :email, :password)");
            // return result
            $username = $this->getUsername();
            $email = $this->getEmail();
            $password = $this->getPassword();

            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $this->password);

            $result = $statement->execute();
            return $result;

        }
}
?>