<?php

namespace App\Core;

abstract class DatabaseDriver
{
	private static $instance;

	abstract public function setId(Int $id);
	abstract public function getId();

	protected $pdo;
	protected $table;

	
	public static function getInstance() {
		if (self::$instance == null) {
		  self::$instance = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=3306" ,DB_USER , DB_PASSWORD );
		  self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		  self::$instance->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		}
		return self::$instance;
	  }

	public function __construct()
	{
		//Connexion avec la bdd
		try{
			$this->pdo=$this::getInstance();
			
		}catch(\Exception $e){
			die("Erreur SQL ".$e->getMessage());
		}

		$CalledClassExploded = explode("\\", get_called_class());
		$this->table = strtolower("rattrapage_".end($CalledClassExploded));

		
	}


	//Insert et Update
	public function save() :void
	{
		$objectVars = get_object_vars($this);
		$classVars = get_class_vars(get_class());
		$columns = array_diff_key($objectVars, $classVars);
		


		if(is_null($this->getId())){

			$objectVars = get_object_vars($this);
			$classVars = get_class_vars(get_class());
			$columns = array_diff_key($objectVars, $classVars);
			
			// INSERT INTO esgi_user (firstname,lastname,email,pwd,status) VALUES (:firstname,:lastname,:email,:pwd,:status) ;
			$sql = "INSERT INTO ".$this->table. " (".implode(",", array_keys($columns) ) .") VALUES (:".implode(",:", array_keys($columns) ) .") ;";
		}else{

			foreach($columns as $column=>$value){
				$sqlUpdate[] = $column."=:".$column;
			}

			$sql = "UPDATE ".$this->table. " SET ".implode(",",$sqlUpdate)."  WHERE id=".$this->getId();
		}

		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute($columns);
	}

	public function findAll() {
		$sql = "SELECT * FROM ".$this->table." ;";

		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute();
		
		$result = $queryPrepared->fetchAll();

		return $result;
	}

	public function findRow(String $column, $value):array|bool {
		$sql = "SELECT * FROM ".$this->table." WHERE ".$column." = :".$column." ;";

		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute([$column=>$value]);
		
		$result = $queryPrepared->fetch();

		return $result;
	}


	public function delete(String $column, $value) {
		$sql = "DELETE FROM ".$this->table." WHERE ".$column." = :".$column." ;";
		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute([$column=>$value]);
		
	}

	public function findUserByEmail($email){
		$sql = "SELECT * FROM rattrapage_user WHERE email=:email";

		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute(array(
			"email" => $email
		));

		$user_data = $queryPrepared->fetch();


		return $user_data;
	}

	public function checkLogin($email, $pwd): bool {
		$user_data = $this->findUserByEmail($email);

		return $user_data && password_verify($pwd, $user_data["pwd"]);
	}

	

}