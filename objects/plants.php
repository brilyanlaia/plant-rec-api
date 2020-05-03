<?php
	class plants{
		private $conn;
		private $table_name = "plants";

		public $id_plant;
		public $plant_name;
		public $plant_desc;


		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM " . $this->table_name . " ORDER BY id_plant DESC ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function readName($id){
			$query = "SELECT plant_name FROM plants WHERE id_plant=$id";
		
			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			 $query = "INSERT INTO " . $this->table_name . " SET plant_name=:plant_name, plant_desc=:plant_desc";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->plant_name=htmlspecialchars(strip_tags($this->plant_name));
	        $this->plant_desc=htmlspecialchars(strip_tags($this->plant_desc));
	        
	        $stmt->bindParam(":plant_name", $this->plant_name);
	        $stmt->bindParam(":plant_desc", $this->plant_desc);
	     

	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}
		function createEval(){
			 $query = "INSERT INTO plant_evaluation " . " SET id_criteria=:id_criteria, id_plant=:id_plant";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));
	        $this->id_plant=htmlspecialchars(strip_tags($this->id_plant));
	        
	        $stmt->bindParam(":id_criteria", $this->id_criteria);
	        $stmt->bindParam(":id_plant", $this->id_plant);
	     

	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}

		function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE id_plant = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->id_plant);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->id_plant = $row['id_plant'];
	        $this->plant_name = $row['plant_name'];
	        $this->plant_desc = $row['plant_desc'];
	       
		}

		function getLast(){
			$query = "SELECT * FROM plants ORDER BY id_plant DESC LIMIT 1";

	        $stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}
		
		function readBobot(){
			
	        $query = "SELECT * FROM bobot" . " WHERE id_plant = ?";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->id_plant);

	        $stmt->execute();

			return $stmt;
		}

		function update(){

			$query = "UPDATE " . $this->table_name . " SET plant_name=:plant_name, plant_desc=:plant_desc  WHERE id_plant = :id_plant";

			$stmt = $this->conn->prepare($query);

			$this->id_plant=htmlspecialchars(strip_tags($this->id_plant));
			$this->plant_name=htmlspecialchars(strip_tags($this->plant_name));
			$this->plant_desc=htmlspecialchars(strip_tags($this->plant_desc));

			$stmt->bindParam(":id_plant", $this->id_plant);
			$stmt->bindParam(":plant_name", $this->plant_name);
			$stmt->bindParam(":plant_desc", $this->plant_desc);

			if($stmt->execute()){
				return true;
			}

			return false;
		}
		function updateEval(){

			$query = "UPDATE plant_evaluation" . " SET weight=:weight WHERE id_plant = :id_plant AND id_criteria = :id_criteria";

			$stmt = $this->conn->prepare($query);

			$this->id_plant=htmlspecialchars(strip_tags($this->id_plant));
			$this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));
			$this->weight=htmlspecialchars(strip_tags($this->weight));

			$stmt->bindParam(":id_plant", $this->id_plant);
			$stmt->bindParam(":id_criteria", $this->id_criteria);
			$stmt->bindParam(":weight", $this->weight);

			if($stmt->execute()){
				return true;
			}

			return false;
		}


    	  function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE id_plant = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_plant=htmlspecialchars(strip_tags($this->id_plant));

	        $stmt->bindParam(1, $this->id_plant);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>
