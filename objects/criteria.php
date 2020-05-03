<?php
	class criteria{
		private $conn;
		private $table_name = "criteria";

		public $id_criteria;
		public $criteria_name;
		public $criteria_desc;


		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM " . $this->table_name . " ORDER BY id_criteria DESC ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function readName($id){
			$query = "SELECT criteria_name FROM criteria WHERE id_criteria=$id";
		
			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			 $query = "INSERT INTO " . $this->table_name . " SET criteria_name=:criteria_name, criteria_desc=:criteria_desc";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->criteria_name=htmlspecialchars(strip_tags($this->criteria_name));
	        $this->criteria_desc=htmlspecialchars(strip_tags($this->criteria_desc));
	        
	        $stmt->bindParam(":criteria_name", $this->criteria_name);
	        $stmt->bindParam(":criteria_desc", $this->criteria_desc);
	     

	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}
		function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE id_criteria = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->id_criteria);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->id_criteria = $row['id_criteria'];
	        $this->criteria_name = $row['criteria_name'];
	        $this->criteria_desc = $row['criteria_desc'];
	       
	    }

		function update(){

			$query = "UPDATE " . $this->table_name . " SET criteria_name=:criteria_name, criteria_desc=:criteria_desc  WHERE id_criteria = :id_criteria";

			$stmt = $this->conn->prepare($query);

			$this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));
			$this->criteria_name=htmlspecialchars(strip_tags($this->criteria_name));
			$this->criteria_desc=htmlspecialchars(strip_tags($this->criteria_desc));

			$stmt->bindParam(":id_criteria", $this->id_criteria);
			$stmt->bindParam(":criteria_name", $this->criteria_name);
			$stmt->bindParam(":criteria_desc", $this->criteria_desc);

			if($stmt->execute()){
				return true;
			}

			return false;
		}
    	  function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE id_criteria = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));

	        $stmt->bindParam(1, $this->id_criteria);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>
