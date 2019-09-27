<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/controller/Controller.php';

class View{

	private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }
	
	public function presentPage($request){
				switch ($request) {
				case '/' :
					require $_SERVER['DOCUMENT_ROOT'].'\views\index.php';
					break;
				case '' :
					require $_SERVER['DOCUMENT_ROOT'].'\views\index.php';
					break;
				case '/index' :
					require $_SERVER['DOCUMENT_ROOT'].'\views\index.php';
					break;
				case '/calendar' :
					require $_SERVER['DOCUMENT_ROOT'].'\views\calendar.php';
					break;
				case '/meatballs':
					$this->updateCommentView('meatballs', $this->controller->fetchComments('meatballs'));
					require $_SERVER['DOCUMENT_ROOT'].'\views\meatballs.php';
					break;
				case '/pancakes':
					$this->updateCommentView('pancakes', $this->controller->fetchComments('pancakes'));
					require $_SERVER['DOCUMENT_ROOT'].'\views\pancakes.php';
					break;
				case '/login':
					require $_SERVER['DOCUMENT_ROOT'].'\views\login.php';
					break;
				case '/login_post':
					$this->login($_POST['username'],$_POST['password']);
					require $_SERVER['DOCUMENT_ROOT'].'\views\login.php';
					break;
				case '/logout_post':
					$this->logout();
					$this->presentPage($_SESSION['prevPage']);
					break;
				case '/post_comment':
					$this->controller->addComment($_SESSION['recipe'], $_SESSION['LoggedInAs'], $_POST['commentText']);
					$this->presentPage('/'.$_SESSION['recipe']);
					break;
				case '/delete_comment':
					$this->controller->deleteComment($_SESSION['recipe'],$_POST['commentID']);
					$this->presentPage('/'.$_SESSION['recipe']); 
					break;
				default:
					require $_SERVER['DOCUMENT_ROOT'].'\views\404.php';
					break;
				}
	}
	
	
	private function updateLoginView($user){
		if($user != null){
			$_SESSION['LogInSuccessful'] = True;
			$_SESSION['LoggedInAs'] = $user;
		}
		else
			$_SESSION['LogInSuccessful'] = False;
	}
	
	private function resetLoginView(){
		unset($_SESSION['LogInSuccessful']);
		unset($_SESSION['LoggedInAs']);
	}
	
	private function updateCommentView($recipe, $commentList){
		$_SESSION['recipe'] = $recipe;
		$GLOBALS[$recipe . '_comments'] = $commentList;
	}
	
	
	public function login($username, $password){
		$user = $this->controller->login($username,$password);
		$this->updateLoginView($user);
	}
	
	public function logout(){
		$this->controller->logout();
		$this->resetLoginView();
	}
		
}