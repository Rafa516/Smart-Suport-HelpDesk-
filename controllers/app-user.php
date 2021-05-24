 <?php

use \Projeto\Page;
use \Projeto\Model\Usuario;

//------------------ROTA DA PÁGINA DE LOGIN--------------------------------//

$app->get('/', function() {  

	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login-usuario",[
		'error'=>Usuario::getError(),
		'profileMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
	]);

});

//------------------ROTA  DO FORMULÁRIO DE REGISTRO DOS USUÁRIOS--------------------------------//

$app->post("/registro", function(){

	if (Usuario::checkEmailExist($_POST['email']) === true) {

		Usuario::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /");
		exit;

	}

	$usuario = new usuario();

	$usuario->setData([
		'inadmin'=>0,
		'login'=>$_POST['email'],
		'nome'=>$_POST['nome'],
		'email'=>$_POST['email'],
		'senha'=>$_POST['senha'],
		'loja'=>$_POST['loja'],
		'cargo'=>$_POST['cargo'],
		'foto'=>0
	]);

	$usuario->cadastroUsuario();

	Usuario::setSuccess("Usuário registrado com sucesso!! Efetue o Acesso");

	header("Location: /");
	exit;


});

//---------ROTA DO FORMULÁRIO DE LOGIN----------------------//

$app->post('/login', function() {

	try {

		Usuario::login($_POST['login'], $_POST['senha']);

	} catch(Exception $e) {

		Usuario::setError($e->getMessage());

		header("Location: /");
		exit;

	}

	header("Location: /usuario");
	exit;

});

//---------ROTA PARA ENCERRAR A SESSÃO----------------------//

$app->get('/usuario/logout', function() {

	Usuario::logout();

	header("Location: /");
	exit;

});


//---------ROTA PARA A PÁGINA INICIAL----------------------//

$app->get('/usuario', function() {  


	Usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario");

});




