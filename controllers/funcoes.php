<?php

use \Projeto\Model\Usuario;



	function formatDate($data)
	{

		return date('d/m/Y', strtotime($data));

	}


	function getUsuarioNome()
	{

		$res = Usuario::getFromSession();

		$usuario =  $res->getnome();

		return utf8_decode($usuario);

	}

	
	
	

?>