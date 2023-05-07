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
                if (empty($firstname)) {
                        throw new Exception("firstname cant be empty");
                }
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
                if(empty($lastname)){
                        throw new Exception("Lastname can't be empty");
                }
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
                if (empty($email)) {
                        throw new Exception("email cant be empty");
                }
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
             $conn = Db::getConnection();

            $options = [
                'cost' => 12
                ];
            $password = password_hash($this->password, PASSWORD_BCRYPT, $options);
           

            $statement = $conn->prepare("insert into users(`firstname`,`lastname`,`username`, `email`, `password`) values (:firstname, :lastname, :username, :email, :password)");

            $statement->bindValue(':firstname', $this->firstname);
            $statement->bindValue(':lastname', $this->lastname);
            $statement->bindValue(':username', $this->username);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $password); 

            return $statement->execute();

        }

        public function canRegister($password, $password2)
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users where email = :email");
                $statement->bindValue(":email", $this->email);
                $statement->execute();
                $user = ($statement->fetch());
                if (!$user) {
                        if ($password == $password2) {
                                return true;
                        } else {
                                throw new Exception("wachtwoorden komen niet overeen");
                                return false;
                        }
                } else {
                        throw new Exception("gebruiker bestaat al");
                        return false;
                }
        }

        public function canLogin(){   
                $conn = Db::getConnection();

                $statement = $conn->prepare("select * from users where username = :username");
                $statement->bindValue(":username", $this->username);
                $statement->execute();
                $user = ($statement->fetch());
                /*var_dump($user);// test if a user excists
                exit();*/
                if (!$user){
                        throw new Exception("User does not exist");
                        return false;
                }

                $hash = $user["password"];
                if( password_verify($this->password, $hash)){
                        return true;
                }
                else{
                        throw new Exception("Wrong Password");
                        return false;
                }


        }

        public function __toString()
        {
                return $this->firstname . " " . $this->lastname . " " . $this->email . " " . $this->email;
        }




}
      



?>