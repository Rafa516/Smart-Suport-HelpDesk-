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