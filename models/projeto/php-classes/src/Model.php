<?php 

namespace Projeto;

//Classe Model(Modelo com os principais métodos)
class Model {

	private $values = [];

	//Método para setar os dados das váriaveis de forma dinâmica
	public function setData($data)
	{

		foreach ($data as $key => $value)
		{

		$this->{"set".$key}($value); //variável de forma dinâmica entre chaves

		}

	}

	//Método Construtor para  passar por parâmetros Get e Set das variáveis dinâmicamente
	public function __call($name, $args)
	{
		//verificando o valor dos 3 primeiros campos para GET ou SET
		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		
			
			switch ($method)
			{

				case "get":
					return (isset($this->values[$fieldName])) ?  $this->values[$fieldName]: NULL;
				break;

				case "set":
					return $this->values[$fieldName] = $args[0];
				break;
			}

	}

	//Método para pegar os valores das váriaveis
	public function getValues()
	{

		return $this->values;

	}

}

?>
