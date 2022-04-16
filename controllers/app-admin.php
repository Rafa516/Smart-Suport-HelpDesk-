<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Chamado;

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


//---------ROTA PARA ENCERRAR A SESSÃO----------------------//

$app->get('/user/logout', function() {

	User::logout();

	header("Location: /");
	exit;

});

//---------ROTA PARA DELETAR O USUÁRIO----------------------//

$app->get("/admin/usuarios/delete/:id_usuario",function($id_usuario){

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);

	$usuario->deletarUsuario();

	Usuario::setSuccess("Usuário removido com sucesso.");

	header("Location: /admin/usuarios");
 	exit;
});

//---------ROTA PARA DELETAR O CHAMADO ----------------------//

$app->get("/admin/chamados/delete/:id_chamado",function($id_chamado){

	$chamado = new Chamado();

	$chamado->get((int)$id_chamado);

	$chamado->delete();

	Usuario::setSuccess("Chamado removido com sucesso.");

	header("Location: /admin/chamados");
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


//---------ROTA PARA O REGISTRO DOS USUÁRIOS----------------------//

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


$app->get('/admin/usuarios/editar/:id_usuario', function($id_usuario){
 
   Usuario::verificaLoginAdmin();
 
   $usuario = new Usuario();
 
   $usuario->get((int)$id_usuario);
 
   $page = new PageAdmin();
 
   $page ->setTpl("admin-usuario-editar", array(
        "usuario"=>$usuario->getValues(),
        'profileMsg'=>Usuario::getSuccess(),
        'errorRegister'=>Usuario::getErrorRegister()  
    ));
 
});


$app->post("/admin/usuarios/editar/:id_usuario",function($id_usuario){

	Usuario::verificaLoginAdmin();

	$usuario = new Usuario();


	$usuario->get((int)$id_usuario);
 
  	$usuario->setData($_POST);

  	$usuario->editarUsuario();

  	Usuario::setSuccess("Dados alterados com Sucesso");

  	header("Location: /admin/usuarios");
  	exit;


});

//---------ROTA PARA A PÁGINA DE TODOS OS CHAMADOS ---------------------//

$app->get('/admin/chamados', function() {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $chamado::getPageSearchAll($search, $page);

	} else {

		$pagination = $chamado::getPageAll($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/chamados?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-chamados",[
	 "chamados"=>$pagination['data'],
	 "search"=>$search,
	 'profileMsg'=>Usuario::getSuccess(),
	 "pages"=>$pages
	]);

});

//---------ROTA PARA A PÁGINA DE TODOS CHAMADOS PENDENTES----------------------//

$app->get('/admin/chamados-pendentes', function() {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $chamado::getPageSearchChamadosPendentes($search, $page);

	} else {

		$pagination = $chamado::getPageChamadosPendentes($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/chamados-pendentes?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-chamados-pendentes",[
	 "chamadosPendentes"=>$pagination['data'],
	 "search"=>$search,
	 'profileMsg'=>Usuario::getSuccess(),
	 "pages"=>$pages

	]);

});

//---------ROTA PARA A PÁGINA DE TODOS CHAMADOS FINALIZADOS----------------------//

$app->get('/admin/chamados-finalizados', function() {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $chamado::getPageSearchChamadosFinalizados($search, $page);

	} else {

		$pagination = $chamado::getPageChamadosFinalizados($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/chamados-finalizados?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-chamados-finalizados",[
	 "chamadosFinalizados"=>$pagination['data'],
	 "search"=>$search,
	 'profileMsg'=>Usuario::getSuccess(),
	 "pages"=>$pages

	]);

});

//---------ROTA PARA A PÁGINA DOS CHAMADOS DOS PROPIETÁRIOS ADMIN----------------------//
$app->get('/admin/chamados-capturados', function() {  


	Usuario::verificaLoginAdmin();

	$usuario = Usuario::getFromSession();


	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $usuario->getPageSearch($search, $page);

	} else {

		$pagination = $usuario->getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/chamados-capturados?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-chamados-capturados",[
		
		"chamados"=>$pagination['data'],
		"search"=>$search,
		'profileMsg'=>usuario::getSuccess(),
		"pages"=>$pages
	]);

});

//---------ROTA PARA A PÁGINA DAS IMAGENS---------------------//

$app->get('/admin/chamados/imagens/:id_chamado', function($id_chamado) {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$page = new PageAdmin();

	$page->setTpl("admin-imagens-chamados",[
		'imagens'=>$chamado->showFotos($id_chamado),
		'chamado'=>$chamado->get($id_chamado)
	]);

});

//---------ROTA PARA A PÁGINA DE SITUAÇÃO DOS CHAMADOS ---------------------//

$app->get('/admin/chamado-situacao/:id_chamado', function($id_chamado) {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$page = new PageAdmin();

	$page->setTpl("admin-situacao-chamado",[
		"id_chamado"=>$chamado->get((int)$id_chamado),
		"chamadoSituacao"=>$chamado->valueSituacao((int)$id_chamado),

	]);

});


//---------ROTA PARA A ALTERAÇÃO DOS CHAMADOS ---------------------//

$app->post("/admin/chamado/atualizar-situacao/:id_chamado",function($id_chamado){

	$chamado = new Chamado();

	$chamado->get((int)$id_chamado);

	$chamado->setData($_POST);

	$chamado->editarSituacao();

	Usuario::setSuccess("Situação alterada com Sucesso");

	header("Location: /admin/chamados");
 	exit;
});

//---------ROTA PARA A PÁGINA DE SOLUÇÃO DOS CHAMADOS ---------------------//

$app->get('/admin/chamado-solucao/:id_chamado', function($id_chamado) {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$page = new PageAdmin();

	$page->setTpl("admin-solucao-chamado",[
		"id_chamado"=>$chamado->get((int)$id_chamado),
		"solucao"=>$chamado->get((int)$id_chamado)	
	]);

});


//---------ROTA PARA A ALTERAÇÃO DA SOLUÇÃO ---------------------//

$app->post("/admin/chamado/atualizar-solucao/:id_chamado",function($id_chamado){

	$chamado = new Chamado();

	$chamado->get((int)$id_chamado);

	$chamado->setData($_POST);

	$chamado->editarSolucao();

	Usuario::setSuccess("Solução incluída com Sucesso");

	header("Location: /admin/chamados");
 	exit;
});

//---------ROTA PARA A PÁGINA DE SOLUÇÃO DOS CHAMADOS FINALIZADOS ---------------------//

$app->get('/admin/chamado-solucao-finalizado/:id_chamado', function($id_chamado) {  


	Usuario::verificaLoginAdmin();

	$chamado = new Chamado();

	$page = new PageAdmin();

	$page->setTpl("admin-solucao-chamado-finalizado",[
		"id_chamado"=>$chamado->get((int)$id_chamado),
		"solucao"=>$chamado->get((int)$id_chamado),
		"problema"=>$chamado->get((int)$id_chamado),
		"data_registro"=>$chamado->get((int)$id_chamado)	
	]);

});


//---------ROTA PARA  A PÁGINA DO PERFIL DO USUÁRIO----------------------//

$app->get('/admin/perfil', function() {  


	Usuario::verificaLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin-perfil",[
	'alteracaoErro'=>Usuario::getError(),
	'alteracaoSucesso'=>Usuario::getSuccess()
	]);

});



//---------ROTA PARA ALTERAR OS DADOS DO USUÁRIO - POST----------------------//

$app->post("/admin/perfil/editar/:id_usuario", function ($id_usuario) {

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);

	$usuario->setData($_POST);

	$usuario-> editarUsuario();

	header('Location: /admin/login');
	exit;

});

//---------ROTA PARA ALTERAR A FOTO DO PERFIL DO USUÁRIO - POST---------------------//

$app->post("/admin/perfil/editar-imagem/:id_usuario", function ($id_usuario) {

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);

	$usuario->setData($_POST);

	$usuario->alterarImagemPerfil();

	header('Location: /admin/login');
	exit;

});

//---------ROTA PARA ALTERAR SENHA DO USUÁRIO  - POST---------------------//

$app->post("/perfil/alterar-senha-admin", function(){



	if ($_POST['senha_atual'] === $_POST['nova_senha']) {

		Usuario::setError("A sua nova senha deve ser diferente da atual.");
		header("Location: /admin/perfil");
		exit;		

	}

	$usuario = Usuario::getFromSession();

	if (!password_verify($_POST['senha_atual'], $usuario->getsenha())) {

		Usuario::setError("A senha atual está inválida.");
		header("Location: /admin/perfil");
		exit;			

	}

	$usuario->setsenha($_POST['nova_senha']);

	$usuario->editarUsuario();

	Usuario::setSuccess("Senha alterada com sucesso.");

	header("Location: /admin/perfil");
	exit;

});

?>


