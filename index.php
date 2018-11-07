<?php 
ini_set('display_errors',1);error_reporting(E_ALL);
session_start();
$ROOT_FOLDER = __DIR__;
$DS = DIRECTORY_SEPARATOR;
require_once ($ROOT_FOLDER.'/lib/File.php');
require_once File::build_path(array('lib','Session.php'));
require_once File::build_path(array('controller','routeur.php'));
?>

	