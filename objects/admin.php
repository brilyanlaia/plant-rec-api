<?php
	class admin{
		private $conn;
		private $table_name = "admin";

		public $username;
		public $password;


		public function __construct($db){
			$this->conn = $db;
		}

        function login(){
            $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
    
            $stmt = $this->conn->prepare( $query );
    
            $stmt->bindParam(1, $this->username);
    
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->username = $row['username'];
            $this->password = $row['password'];
        }

	
  
	}
?>
