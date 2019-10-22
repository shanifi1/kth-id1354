<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\integration\DatabaseHandler.php';

class Authenticator{
	
	private $dbHandler = null;
	private $userLoggedIn = False;
	private $user = null;
	
	/*
	Creates an instance of the class. Validates user credentials and 
	saves the result in private member variables.
	@param $username the username @param $password the password
	*/
    public function __construct($username, $password){
		$this->dbHandler = new DatabaseHandler();
		
		$sqlResultVector = $this->dbHandler->select('SELECT Username, Password FROM users WHERE Username = '.'"'.$username.'"');
		if(isset($sqlResultVector[0])){
			$this->user = $sqlResultVector[0];
			
			if($this->user['Password'] === $password)
			$this->userLoggedIn = True;
			else
			$this->userLoggedIn = False;
			
			
		}
		else
			$this->userLoggedIn = False;

    }
	
	public function isLoggedIn(){
		return $this->userLoggedIn;
	}
}