<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;

//------------------ROTA DA PÁGINA DE LOGIN--------------------------------//

$app->get('/admin/login', function() {  

	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login-admin",[
		'error'=>Usuario::getError(),
		'profileMsg'=>Usuario::getSuccess(),
	]);

});

//---------ROTA PARA DELETAR O USUÁRIO----------------------//

$app->get("/admin/usuarios/delete/:id_usuario",function($id_usuario){

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);

	$usuario->delete();

	Usuario::setSuccess("Usuário removido com sucesso.");

	header("Location: /admin/usuarios");
 	exit;
});

//---------ROTA DO FORMULÁRIO DE LOGIN----------------------//

$app->post('/admin/login', function() {

	try {

		Usuario::login($_POST['login'], $_POST['senha']);

	} catch(Exception $e) {

		Usuario::setError($e->getMessage());

		header("Location: /admin/login");
		exit;

	}

	header("Location: /admin");
	exit;

});

//---------ROTA PARA O ENCERRAMENTO DA SESSÃO (LOGOUT)----------------------//

$app->get('/admin/logout', function() {

	Usuario::logout();

	header("Location: /admin/login");
	exit;

});

//---------ROTA PARA A PÁGINA INDEX (PAINEL) ----------------------//

$app->get('/admin', function() {  


	Usuario::verificaLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin");

});

//---------ROTA PARA A PÁGINA DOS USUÁRIOS CADASTRADOS----------------------//

$app->get('/admin/usuarios', function() {  


	Usuario::verificaLoginAdmin();

	$usuario = new Usuario();


	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $usuario->getPageSearchUsers($search, $page);

	} else {

		$pagination = $usuario->getPageUsers($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/usuarios?page='.$i,
			'page'=>$i,
			'search'=>$search,
			
	]);
		
	}

	$page = new PageAdmin();
	
	
	$page->setTpl("admin-usuarios", array(	
		"usuarios"=>$pagination['data'],
		"search"=>$search,
		'profileMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"pages"=>$pages
		
	));

});

//---------ROTA PARA O REGISTRO DOS USUÁRIOS ADMINISTRADORES----------------------//

$app->post("/admin/usuarios/registro", function(){

	if (Usuario::checkEmailExist($_POST['email']) === true) {

		Usuario::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /admin/usuarios");
		exit;

	}

	if (Usuario::checkLoginExist($_POST['login']) === true) {

		Usuario::setErrorRegister("Este Login já está sendo usado por outro usuário.");
		header("Location: /admin/usuarios");
		exit;

	}

	$usuario = new Usuario();

	$usuario->setData([
		'inadmin'=>$_POST['inadmin'],
		'login'=>$_POST['login'],
		'nome'=>$_POST['nome'],
		'email'=>$_POST['email'],
		'senha'=>$_POST['senha'],
		'loja'=>$_POST['loja'],
		'cargo'=>$_POST['cargo'],
		'foto'=>0
	]);

	$usuario->cadastroUsuario();

	Usuario::setSuccess("Usuário cadastrado com sucesso");

	header('Location: /admin/usuarios');
	exit;

});
