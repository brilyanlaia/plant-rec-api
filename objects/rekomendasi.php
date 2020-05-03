<?php
	class rekomendasi{
		private $conn;
		private $table_name = "plant_evaluation";

		public $id_plant;
		public $id_criteria;
		public $weight;


		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM " . $this->table_name . " ORDER BY id_plant,id_criteria";

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
	/* 	function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_E = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->ID_E);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->nama_e = $row['nama_e'];
	        $this->lokasi_e = $row['lokasi_e'];
	        $this->tanggal_e = $row['tanggal_e'];
	        $this->waktu_e = $row['waktu_e'];
			$this->jumlah_m = $row['jumlah_m'];
			$this->createdby = $row['createdby'];
			$this->createdat = $row['createdat'];
			$this->modifiedby = $row['modifiedby'];
			$this->notes = $row['notes'];
	    }
 */
/* 	     function update(){

	        $query = "UPDATE " . $this->table_name . " SET nama_e=:nama_e, lokasi_e=:lokasi_e, tanggal_e=:tanggal_e, waktu_e=:waktu_e, jumlah_m=:jumlah_m, modifiedby=:modifiedby, notes=:notes WHERE ID_E = :ID_E";

	        $stmt = $this->conn->prepare($query);

	        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
	        $this->nama_e=htmlspecialchars(strip_tags($this->nama_e));
	        $this->lokasi_e=htmlspecialchars(strip_tags($this->lokasi_e));
	        $this->tanggal_e=htmlspecialchars(strip_tags($this->tanggal_e));
	        $this->waktu_e=htmlspecialchars(strip_tags($this->waktu_e));
			$this->jumlah_m=htmlspecialchars(strip_tags($this->jumlah_m));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));
	        $this->notes=htmlspecialchars(strip_tags($this->notes));
	    
	    	$stmt->bindParam(":ID_E", $this->ID_E);
	        $stmt->bindParam(":nama_e", $this->nama_e);
	        $stmt->bindParam(":lokasi_e", $this->lokasi_e);
	        $stmt->bindParam(":tanggal_e", $this->tanggal_e);
	        $stmt->bindParam(":waktu_e", $this->waktu_e);
	        $stmt->bindParam(":jumlah_m", $this->jumlah_m);
			$stmt->bindParam(":modifiedby", $this->modifiedby);
			$stmt->bindParam(":notes", $this->notes);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
    	} */
    	  function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE plant_id = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->ID_E=htmlspecialchars(strip_tags($this->plant_id));

	        $stmt->bindParam(1, $this->plant_id);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>
