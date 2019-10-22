<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\integration\DatabaseHandler.php';
/*
Handles the fetching, adding and deletion of comments from a database
*/
class CommentHandler{
	private $dbHandler = null;
	
	/*
	Creates an instance of the class and creates a reference to the databasehandler
	*/
	public function __construct() {
		$this->dbHandler = new DatabaseHandler();		
	}
	/*
	Fetches comments for a specified recipe from the database
	@param $recipe the recipe
	@return an array of comments i the format of sql-rows.
	*/
	public function fetchComments($recipe){
		return $this->dbHandler->select('SELECT * FROM '.$recipe.'_comments');
	}
	
	
	/*
	Deletes a comment from the database
	@param $recipe the recipe @param $commentID the commentID
	*/
	public function deleteComment($recipe, $commentID){
		$this->dbHandler->delete('DELETE FROM '.$recipe.'_comments WHERE CommentID='.$commentID);
	}
	
	/*
	Adds a comment to the database
	@param $recipe the recipe which is commented on @param $username the username of the comment-writer @param $commentText the written comment
	*/
	public function addComment($recipe, $username, $commentText){
		$result = $this->dbHandler->select('SELECT MAX(CommentID) FROM '.$recipe.'_comments');
		$maxid = $result[0]['MAX(CommentID)'];
		$this->dbHandler->insert('INSERT INTO '.$recipe.'_comments'.' VALUES (\''.$username.'\', \''.$commentText.'\', \''.($maxid+1).'\')');
	}
}