<?php
class agenda{
private $conn;

public $name;
public $number;
private $table_name = "agenda";

public function __construct($db){
        $this->conn = $db;
    }
    function comprobar(){
    	$query = "SELECT nombre FROM " . $this->table_name . " WHERE nombre=:name "; 
    	
		$stmt = $this->conn->prepare( $query );

		$this->name=htmlspecialchars(strip_tags($this->name));
		$stmt->bindParam(":name", $this->name);

		$stmt ->execute();
		$row = $stmt->rowCount();

		if ($row<1){
			$this->insertar();
			return true;
		}else{
			$this->actualizar();
			return true;
		}
    }
	function insertar(){
		$query = "INSERT INTO " . $this->table_name . " SET nombre=:name,  number=:number ";
		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
        $this->number=htmlspecialchars(strip_tags($this->number));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":number", $this->number);

       	if ($stmt->execute()){
       		return true;
       	}else{
       		return false;
       	}
	}
	function actualizar(){
		$query ="UPDATE " . $this->table_name . " SET nombre=:name, number=:number WHERE nombre=:name ";

		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
        $this->number=htmlspecialchars(strip_tags($this->number));
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":number", $this->number);

       	if ($stmt->execute()){
       		return true;
       	}else{
       		return false;
       	}

	}
	function leer(){
		$query = "SELECT nombre, number FROM " . $this->table_name; 
	
		$stmt = $this->conn->prepare( $query );
		$stmt ->execute();
		return $stmt;
	}
	function borrar(){

		$query = "DELETE FROM " . $this->table_name . " WHERE nombre=:name ";

		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		 $stmt->bindParam(":name", $this->name);

       	if ($stmt->execute()){
       		return true;
       	}else{
       		return false;
       	}
	}
}
?>