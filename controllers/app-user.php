 <?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Chamado;

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

//---------ROTA PARA A ABERTURA DE CHAMADOS----------------------//


$app->get('/usuario/abertura-chamado', function() {  


	usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario-abertura-chamado",[
		'CallOpenMsg'=>usuario::getSuccess(),
		'errorRegister'=>usuario::getErrorRegister()
	]);

});

//---------ROTA PARA O FORMULÁRIO DO CHAMADO----------------------//


$app->post("/usuario/abertura-chamado/enviar", function(){

	usuario::verificaLogin();

	$chamado = new Chamado();


	$chamado->setData($_POST);

	$chamado->registrarChamados();

	usuario::setSuccess("Chamado registrado com sucesso!!");

	header("Location: /usuario/abertura-chamado");
	exit;


});


//---------ROTA PARA DELETAR UM CHAMADO ----------------------//

$app->get("/usuario/chamados/delete/:id_chamado",function($id_chamado){

	$chamado = new Chamado();

	$chamado->get((int)$id_chamado);

	$chamado->delete();

	Usuario::setSuccess("Chamado removido com sucesso.");

	header("Location: /usuario/meus-chamados");
 	exit;
});


//---------ROTA PARA A PÁGINA DOS CHAMADOS DO USUÁRIO----------------------//
$app->get('/usuario/meus-chamados', function() {  


	Usuario::verificaLogin();

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
			'link'=>'/usuario/meus-chamados?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new Page();

	$page->setTpl("usuario-meus-chamados",[
		
		"chamados"=>$pagination['data'],
		"search"=>$search,
		'profileMsg'=>usuario::getSuccess(),
		"pages"=>$pages
	]);

});

//---------ROTA PARA A PÁGINA DAS IMAGENS DO CHAMADO----------------------//

$app->get('/usuario/meus-chamados/imagens/:id_chamado', function($id_chamado) {  


	Usuario::verificaLogin();

	$chamado = new Chamado();

	$page = new Page();

	$page->setTpl("usuario-imagens-chamados",[
		'imagens'=>$chamado->showFotos($id_chamado),
		'chamado'=>$chamado->get($id_chamado)

	]);

});




