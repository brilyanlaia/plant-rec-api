<?php
	class criterias{
		private $conn;
		private $table_name = "check_criteria";

		public $id_criteria;
		public $weight;
		public $attribute;


		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT id_criteria,attribute FROM " . $this->table_name . " ORDER BY id_criteria DESC ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			 $query = "INSERT INTO " . $this->table_name . " SET id_criteria=:id_criteria, attribute=:attribute";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));
	        $this->attribute=htmlspecialchars(strip_tags($this->attribute));
	        
	        $stmt->bindParam(":id_criteria", $this->id_criteria);
	        $stmt->bindParam(":attribute", $this->attribute);
	     

	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
        }

        //buat direkomendasi
        function readCriteria(){
            $query = "SELECT id_criteria,weight,attribute FROM " . $this->table_name . " ORDER BY id_criteria DESC ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
        }
        

















	/* 	function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE id_criteria = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->id_criteria);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->weight = $row['weight'];
	        $this->attribute = $row['attribute'];
	        $this->tanggal_e = $row['tanggal_e'];
	        $this->waktu_e = $row['waktu_e'];
			$this->jumlah_m = $row['jumlah_m'];
			$this->createdby = $row['createdby'];
			$this->createdat = $row['createdat'];
			$this->modifiedby = $row['modifiedby'];
			$this->notes = $row['notes'];
	    }
 */
	     function update(){

	        $query = "UPDATE " . $this->table_name . " SET weight=:weight, attribute=:attribute  WHERE id_criteria = :id_criteria";

	        $stmt = $this->conn->prepare($query);

	        $this->id_criteria=htmlspecialchars(strip_tags($this->id_criteria));
	        $this->weight=htmlspecialchars(strip_tags($this->weight));
	        $this->attribute=htmlspecialchars(strip_tags($this->attribute));
	    
	    	$stmt->bindParam(":id_criteria", $this->id_criteria);
	        $stmt->bindParam(":weight", $this->weight);
	        $stmt->bindParam(":attribute", $this->attribute);

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
