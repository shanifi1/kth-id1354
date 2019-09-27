<?php

class Authenticator{
	
	private $userLoggedIn = False;
	private $user = null;
	
    public function __construct($user, $password){
		$this->user = $user;
		
		if($this->user['Password'] === $password)
			$this->userLoggedIn = True;
		else
			$this->userLoggedIn = False;
    }
	
	public function isLoggedIn(){
		return $this->userLoggedIn;
	}
}