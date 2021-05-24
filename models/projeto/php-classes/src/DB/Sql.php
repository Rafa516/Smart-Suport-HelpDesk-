<?php 

namespace Projeto\DB;

//Classe Sql(SQL, principais métodos com a conexão com o Banco de Dados e suas DDL E DML)
class Sql {

	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "280389";
	const DBNAME = "db_smart_suport";

	private $conn;

	//Método construtor para a conexão com o banco de dados através do PDO
	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD,
			array(
             \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
         )
		);

	}

	//Método privado para setar o bindParam
	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	//Método passar por parametro os valores do bindParam
	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	//Método para utilizar as buscas sem procedimentos
	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}
	//Método para utilizar as buscas principalmente com procedimentos
	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>