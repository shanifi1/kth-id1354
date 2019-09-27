<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\authentication\Authenticator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\integration\DatabaseHandler.php';


class Controller{
	private $dbHandler = null;
	private $commentHandler = null;
	private $authenticator = null;
	
    public function __construct($commentHandler, $dbHandler) {
		$this->commentHandler = $commentHandler;
		$this->dbHandler = $dbHandler;		
	}
	
	public function fetchComments($recipe){
		return $this->dbHandler->select('SELECT * FROM '.$recipe.'_comments');
	}
	
	public function deleteComment($recipe, $commentID){
		$this->dbHandler->delete('DELETE FROM '.$recipe.'_comments WHERE CommentID='.$commentID);
	}
	
	public function addComment($recipe, $username, $commentText){
		$result = $this->dbHandler->select('SELECT MAX(CommentID) FROM '.$recipe.'_comments');
		$maxid = $result[0]['MAX(CommentID)'];
		$this->dbHandler->insert('INSERT INTO '.$recipe.'_comments'.' VALUES (\''.$username.'\', \''.$commentText.'\', \''.($maxid+1).'\')');
	}
	
	public function login($username, $password){
		$user = $this->dbHandler->select('SELECT Username, Password FROM users WHERE Username = '.'"'.$username.'"');
		
		$this->authenticator = new Authenticator($user[0], $password);
		if($this->authenticator->isLoggedIn())
			return $username;
		else
			return null;
	}
	
	public function logout(){
		$this->authenticator = null;
	}
	
}