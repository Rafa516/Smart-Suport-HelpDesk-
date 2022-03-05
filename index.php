<?php 
session_start();

//dependências
require_once("models/autoload.php");

//name space

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("controllers/app-user.php");
require_once("controllers/app-admin.php");
require_once("controllers/funcoes.php");







$app->run();

 ?>