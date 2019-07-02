<?php
    class DB_CONFIG{

        private $conn;

        //Construct
        function __construct(){
            
        }

        //Connect
        function db_connect(){
            $this->conn = new PDO('mysql:host=localhost;dbname=hr','root','');
            return $this->conn;
        }
    }
?>