<?php
  namespace MyApp;
    abstract class Db {
        private static $conn;

        private static function getConfig(){
            // get the config file
            return parse_ini_file("config/config.ini");
        }
        

        public static function getInstance() {
            include_once(__DIR__ . "/../config/settings.php");// added for database connection 17042023

            if(self::$conn != null) {
                // REUSE our connection
                // echo "🚀";
                return self::$conn;
            }
            else {
                // CREATE a new connection

                // get the configuration for our connection from one central settings file
                $config = self::getConfig();
                $database = $config['database'];
                $user = $config['user'];
                $password = $config['password'];
                $host = $config['host'];

                // echo "💥";
                //self::$conn = new PDO("mysql:host=$host;dbname=".$database, $user, $password);
                //self::$conn = new PDO("mysql:host=$host;dbname=".$database, $user, $password);
                self::$conn = new PDO('mysql:host='. SETTINGS['db']['host'] . ';dbname='. SETTINGS['db']['db'], SETTINGS['db']['user'], SETTINGS['db']['password']);
                //$conn = new PDO('mysql:host=127.0.0.1;dbname=phpendproject',"root", "root");
                return self::$conn;
            }
        }
    }