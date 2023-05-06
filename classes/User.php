<?php
        include_once(__DIR__ . "/Db.php");

class User{
        private $username;
        private $firstname;
        private $lastname;
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
         * Get the value of firstname
         */ 
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
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
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
                $this->lastname = $lastname;

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

        public function register(){
            // conn
            $conn = Db::getInstance();
            //$conn = new PDO('mysql:host=127.0.0.1;dbname=phpendproject',"root", "root");
            // insert query

            $options = [
                'cost' => 12
                ];
                
            //$password = password_hash($this->password, PASSWORD_BCRYPT, $options);
            $statement = $conn->prepare("insert into users(`firstname`,`lastname`,`userName`, `email`, `password`) values (:firstname, :lastname, :username, :email, :password)");
            // return result
            $username = $this->getUsername();
            $email = $this->getEmail();
            $password = $this->getPassword();

            $statement->bindValue(':firstname', $this->firstname);
            $statement->bindValue(':lastname', $this->lastname);
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $this->password);

            $result = $statement->execute();
            return $result;

        }
}
        function canLogin($username,/* $email, */ $password){   
                $conn = Db::getInstance();

                $statement = $conn->prepare("select * from users where username = :username");
                $statement->bindValue(":username", $username);
                $statement->execute();
                $user = $statement->fetch();
                /*var_dump($user);// test if a user excists
                exit();*/
                if (!$user){
                return false;
                }

                $hash = $user['password'];
                if( password_verify($password, $hash)){
                        return true;
                }
                else{
                        return false;
                }


        }



?>