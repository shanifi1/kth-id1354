<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\controller\Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\integration\DatabaseHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\view\View.php';


class Startup{
	
	private $view = null;
	
    public function __construct(){
        $this->controller = new Controller(new DatabaseHandler());
		$this->view = new View($this->controller);
    }
	
}