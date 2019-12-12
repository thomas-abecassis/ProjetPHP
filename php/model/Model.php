<?php

require_once File::build_path('config/Conf.php');

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
        catch (PDOException $e) {
			if (Conf::getDebug()) {
			  echo $e->getMessage(); // affiche un message d'erreur
			} else {
			  echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			}
			die();
		}
	}

	public static function selectAll(){
		$table_name=static::$object;
		$class_name="Model".ucfirst($table_name);
		$rep=Model::$pdo->query("select * from ".$table_name);
  		return $rep->fetchAll(PDO::FETCH_CLASS, $class_name); 
	}


	public static function select($primary_value){
		$table_name=static::$object;
		$class_name="Model".ucfirst($table_name);
		$primary_key=static::$primary;

	    $sql = "SELECT * from ".$table_name." WHERE ".$primary_key." =:nom_tag";
	    // Préparation de la requête
	    $req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" => $primary_value,
	        //nomdutag => valeur, ...
	    );
	    // On donne les valeurs et on exécute la requête	 
	    $req_prep->execute($values);

	    // On récupère les résultats comme précédemment
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    $tab_voit = $req_prep->fetchAll();
	    // Attention, si il n'y a pas de résultats, on renvoie false
	    if (empty($tab_voit))
	        return false;
	    return $tab_voit[0];	
	}

	public static function delete($primary_value){
		$table_name=static::$object;
		$class_name="Model".ucfirst($table_name);
		$primary_key=static::$primary;

	    $sql = "DELETE from ". static::$object ." WHERE " .static::$primary. "=:nom_tag";
	    // Préparation de la requête
	    $req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" => $primary_value,
	        //nomdutag => valeur, ...
	    );
	    // On donne les valeurs et on exécute la requête	 
	    $req_prep->execute($values);
	}

 public function save(){


		$data=$this->getTab();

	  	$sql = "INSERT INTO " . static::$object . " VALUES ( ";
	  	foreach($data as $cle => $valeur){
	  		$sql=$sql.":".$cle." , ";
	  	};
	  	$sql=rtrim($sql,', ');
	  	$sql=$sql.')';

	    // Préparation de la requête
	    $req_prep = Model::$pdo->prepare($sql);

	    $req_prep->execute($data);

  }

  public static function update($data){
  	$sql = "UPDATE " . static::$object . " SET ";
  	foreach($data as $cle => $valeur){
  		$sql=$sql.$cle." =:".$cle.", ";
  	};
  	$sql=rtrim($sql,', ');
  	$sql=$sql." WHERE ".static::$primary.'=:'.static::$primary;


    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $req_prep->execute($data);
  }

}

Model::Init();

?>