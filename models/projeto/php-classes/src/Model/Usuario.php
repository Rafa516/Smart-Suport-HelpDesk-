<?php 

namespace Projeto\Model;


use \Projeto\Model;
use \Projeto\DB\Sql;

//Classe Usuario(Usuários, com seus métodos específicos)
class Usuario extends Model {

	const SESSION = "Usuario";
	const ERROR = "UsuarioError";
	const ERROR_REGISTER = "UsuarioErrorRegister";
	const SUCCESS = "UsuarioSucesss";

	//Método estático para verificação e validação do usuário comum e do administrador
	public static function login($login, $senha)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios  WHERE login = :login", array(
			":login"=>$login
		)); 

		if (count($results) === 0) {
			throw new \Exception("Falha na sua tentativa de login.Conta não cadastrada");
		}


		$data = $results[0];


		if (password_verify($senha, $data['senha']) === true) {

			$Usuario = new Usuario();

			$data['nome'] = utf8_encode($data['nome']);

			$Usuario->setData($data);


			$_SESSION[Usuario::SESSION] = $Usuario->getValues();

			return $Usuario;

		} else {

			throw new \Exception("Falha na sua tentativa de login. Senha inválida");



		}

	}

	//Método estático para verificar se o email do usuário já existe
	public static function checkEmailExist($email)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :email", [
			':email'=>$email
		]);

		return (count($results) > 0);

	}

	//Método estático para verificar se o login do usuário já existe
	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :login", [
			':login'=>$login
		]);

		return (count($results) > 0);

	}

	
 	//Método estático para encerrar a sessão do usuário (logout)
	public static function logout()
	{

		$_SESSION[Usuario::SESSION] = NULL;

	}

	//Método estático para criptografar as senhas registradas dos usuários
	public static function getPasswordHash($senha)
	{

		return password_hash($senha, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	//Método estático para pegar a sessão dos usuários
	public static function getFromSession()
	{

		$Usuario = new Usuario();

		if (isset($_SESSION[Usuario::SESSION]) && (int)$_SESSION[Usuario::SESSION]['id_usuario'] > 0) {

			$Usuario->setData($_SESSION[Usuario::SESSION]);

		}

		return $Usuario;

	}

	//Método estático para verificar a autenticidade do usuário comum, e verificar se ele esta com a sessão iniciada ou não.
	public static function verificaLogin($inadmin = true)
	{

		if (	
			(bool)$_SESSION[Usuario::SESSION]["id_usuario"] !== $inadmin
			||
			(int)$_SESSION[Usuario::SESSION]["inadmin"] !== 0
		) {
			
			header("Location: /");
			exit;

		}

	}

	//Método estático para verificar a autenticidade do usuário Administrador, e verificar se ele esta com a sessão iniciada ou não.
	public static function verificaLoginAdmin($inadmin = true)
	{

		if (
			
			(bool)$_SESSION[Usuario::SESSION]["id_usuario"] !== $inadmin
			||
			(int)$_SESSION[Usuario::SESSION]["inadmin"] !== 1
		) {
			
			header("Location: /admin/login");
			exit;

		}

	}

	
	//Método para selecionar todos os usuários e passar a ID como parâmetro
	public function get($id_usuario)
	{
	 
		 $sql = new Sql();
		 
		 $results = $sql->select("SELECT * FROM tb_usuarios  WHERE id_usuario = :id_usuario", array(
		 ":id_usuario"=>$id_usuario
		 ));

		 
		 $this->setData($results[0]);
	 
	 }

	 //Método para salvar os dados do procedimento de registro do usuário comum.
	public function cadastroUsuario()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_cadastro_usuario(:nome,:login,:senha,:email,:inadmin,:loja,:cargo,:foto)",array(
			":nome"=>$this->getnome(),
			":login"=>$this->getlogin(),
			":senha" => Usuario::getPasswordHash($this->getsenha()),
			":email"=>$this->getemail(),
			":inadmin"=>$this->getinadmin(),
			":loja"=>$this->getloja(),
			":cargo"=>$this->getcargo(),
			":foto"=>$this->getfoto()

		));

		$this->setData($results[0]);

	}

	 //Método para editar os dados do procedimento  do usuário comum.
	public function editarUsuario()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_editar_usuario(:id_usuario,:nome,:loja,:inadmin,:cargo)",array(
			":id_usuario"=>$this->getid_usuario(),
			":nome"=>$this->getnome(),
			":loja"=>$this->getloja(),
			":inadmin"=>$this->getinadmin(),
			":cargo"=>$this->getcargo(),
		));

		$this->setData($results[0]);

	}

	//Método para editar a imagem do perfil
	public function alterarImagemPerfil()
    {
        $sql = new Sql();
 
        $results = $sql->select('CALL sp_alterar_imagem_perfil(:id_usuario,:foto)', [
            ":id_usuario" => $this->getid_usuario(),
            ":foto"=>Usuario::getImage($this->getfoto())
           ,
        ]);

        if($this->getfoto() != 0)
        {

	        $img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
				$this->getfoto();
				unlink($img);

		}
		else
		{
			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
			     $this->getfoto();
			     $img;

				
		}

    }
	
	//Método estático para nomear e mover a imagem para a pasta de destino 
    public static function getImage($value)
	{
		$name_file = date('Ymdhms');

		$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"ft_perfil" . DIRECTORY_SEPARATOR .
			$name_file;	
			     			
			$foto = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;
			
				if (!$foto['error']){
					
					 move_uploaded_file($foto['tmp_name'],$directory);

					return $name_file;

				} else {

					return 0;

				}
	}

	//Método para deletar os usuários
	public function deletarUsuario()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario", [
			':id_usuario'=>$this->getid_usuario()
		]);

			if($this->getinadmin() == 1 && $this->getfoto() != 0){

				$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
					"res" . DIRECTORY_SEPARATOR . 
					"ft_perfil" . DIRECTORY_SEPARATOR . 
					$this->getfoto();
					unlink($img);
			}
			else{

				$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
					"res" . DIRECTORY_SEPARATOR . 
					"ft_perfil" . DIRECTORY_SEPARATOR . 
					$this->getfoto();

			}

	}

	//PAGINAÇÃO DA PÁGINA  USUÁRIOS
	public  function getPageUsers($page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios  ORDER BY data_registro desc
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//Método estático para verificar o total de usuários registrados
	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['totalUsuarios'=>(int)$resultTotal[0]["nrtotal"]];
	}
	

	//PAGINAÇÃO DA PÁGINA MEUS CHAMADOS
	public  function getPage($page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_chamados WHERE id_usuario = :id_usuario ORDER BY data_registro DESC
			LIMIT $start, $itemsPerPage", [	 

			':id_usuario'=>$this->getid_usuario()
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA MEUS CHAMADOS

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_chamados 
			WHERE problema LIKE :search  OR observacao LIKE :search OR id_chamado LIKE :search 
			ORDER BY data_registro DESC
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}
	

	//BUSCA DA PÁGINA USUÁRIOS

	public static function getPageSearchUsers($search, $page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios
			WHERE id_usuario LIKE :search  OR email LIKE :search OR nome LIKE :search OR login LIKE :search
			OR cargo LIKE :search  OR loja LIKE :search 
			ORDER BY data_registro DESC
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	


	//Método estático que seta a mensagem de erro
	public static function setError($msg)
	{

		$_SESSION[Usuario::ERROR] = $msg;

	}

	//Método estático que pega a mensagem de erro
	public static function getError()
	{

		$msg = (isset($_SESSION[Usuario::ERROR]) && $_SESSION[Usuario::ERROR]) ? $_SESSION[Usuario::ERROR] : '';

		Usuario::clearError();

		return $msg;

	}

	//Método estático que limpa a mensagem de erro
	public static function clearError()
	{

		$_SESSION[Usuario::ERROR] = NULL;

	}
	//Método estático que seta a mensagem de sucesso
	public static function setSuccess($msg)
	{

		$_SESSION[Usuario::SUCCESS] = $msg;

	}

	//Método estático que seta a mensagem de sucesso
	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Usuario::SUCCESS]) && $_SESSION[Usuario::SUCCESS]) ? $_SESSION[Usuario::SUCCESS] : '';

		Usuario::clearSuccess();

		return $msg;

	}
	//Método estático que limpa a mensagem de sucesso
	public static function clearSuccess()
	{

		$_SESSION[Usuario::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Usuario::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Usuario::ERROR_REGISTER]) && $_SESSION[Usuario::ERROR_REGISTER]) ? $_SESSION[Usuario::ERROR_REGISTER] : '';

		Usuario::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[Usuario::ERROR_REGISTER] = NULL;

	}


	



}

 ?>