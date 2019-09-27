<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\controller\Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\model\CommentHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\integration\DatabaseHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\view\View.php';


class Startup{
	
	private $view = null;
	
    public function __construct(){
        $this->controller = new Controller(new CommentHandler(),new DatabaseHandler());
		$this->view = new View($this->controller);
    }
	
	public function getView(){
		return $this->view;
	}
	
}