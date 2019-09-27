<?php

class User{
	
	private $username = null;
	private $password = null;
	
    public function __construct($username, $password) {
			$this->username = $username;
			$this->password = $password;

    }
	
	public function getUsername($username){
		return $this->username;
	}
	
	public function getPassword($password){
		return $this->password;
	}

}