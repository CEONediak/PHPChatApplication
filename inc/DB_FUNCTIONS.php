<?php
    class DB_FUNCTIONS{
     
        private $conn;

        function __construct()
        {
            
            require_once 'DB_CONFIG.php';
            $database = new DB_CONFIG();
            $this->conn = $database->db_connect();

        }

        /**
         * Employee authentication
         */
        public function employee_login($usr_username,$usr_password){
           
            $salt1 = "Silent";$salt2 = '_T_T';
		    $encrypted_password = hash('ripemd128', "$salt1$usr_password$salt2");

            $sql = "SELECT * FROM users WHERE usr_username = ? AND usr_password =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($usr_username,$encrypted_password));
            $result = $stmt->fetchAll();
            return $result;

        }

        //get message by username
        public function get_messages_by_username($username){

            $sql = "SELECT * FROM inbox WHERE username = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($username));
            $result = $stmt->fetchAll();
            return $result;

        }

        //get all users
       public function get_all_users($username){

        $sql = "SELECT * FROM users WHERE usr_username != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($username));
        $result = $stmt->fetchAll();
        return $result;
       }


       //get users by id
       public function get_user_by_id($usr_username){

        $sql = "SELECT * FROM users WHERE usr_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($usr_username));
        $result = $stmt->fetch();
        return $result;
       }

       //Insert message
    public function insert_message($username,$message,$from_username){

        $status = "sent";
        $sql = "INSERT INTO inbox(username,message,from_username,status)VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($username,$message,$from_username,$status));
        $result = $stmt->fetch();
        return $result;
    }
       

  
    }
?>