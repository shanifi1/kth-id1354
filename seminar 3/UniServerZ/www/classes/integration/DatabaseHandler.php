<?php

class DatabaseHandler{
	private $db = "TastyRecipes";
	private $dbconnect = null;
	private $hostname = "localhost";
	private $username = "siavash";
	private $password = "Seminar3Db";
	
    public function __construct() {
		$this->dbconnect = mysqli_connect($this->hostname,$this->username,$this->password,$this->db);
		if ($this->dbconnect->connect_error) {
			die("Database connection failed: " . $dbconnect->connect_error);
		}
    }
	
	
	public function update(){
	}
	
	public function select($queryString){
		$result = new \Ds\Vector();
		
		$query = mysqli_query($this->dbconnect, $queryString) or die (mysqli_error($this->dbconnect));
		
		while($row = mysqli_fetch_array($query) ){
			$result->push($row);
		}
		return $result->toArray();
	}
	
	public function delete($queryString){
		mysqli_query($this->dbconnect, $queryString) or die (mysqli_error($this->dbconnect));
	}
	
	public function insert($queryString){
		mysqli_query($this->dbconnect, $queryString) or die (mysqli_error($this->dbconnect));
	}
	
	
}