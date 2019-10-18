<?php

require_once '../config/Conf.php';

class Model{
	public static $pdo;

	public static function Init(){
		$hostname=Conf::getHostName();
		$database_name=Conf::getDatabase();
		$login=Conf::getLogin();
		$password=Conf::getPassword();
		try {
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));		}
        catch (Exception $e) {
			echo "oupsi";
			die();	
		}
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}

Model::Init();

?>