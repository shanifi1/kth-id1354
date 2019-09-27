<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\classes\startup\Startup.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$request = $_SERVER['REQUEST_URI'];
	
if (!isset($_SESSION['startup'])) {
	$startup = new Startup();
	$startup->getView()->presentPage($request);
	$SESSION['startup'] = serialize($startup);
}

else{
	$startup = unserialize($_SESSION['startup']);
	$startup->getView()->presentPage($request);
}