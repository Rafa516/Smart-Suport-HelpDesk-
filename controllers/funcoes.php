<?php

use \Projeto\Model\Usuario;
use \Projeto\Model\Chamado;



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

	function totalUsuarios(){

		$total = Usuario::total();

	   return  $total['totalUsuarios'];

	}

	function totalChamados(){

		$total = Chamado::totalChamados();
	

	   return  $total['chamadosTotal'];

	}

	function totalChamadosID($iduser){

		$total = Chamado::totalChamadosID($iduser);
	

	   return  $total['chamadosTotalID'];

	}
	

	function numFotos($id_chamado){

		$total = Chamado::numFotos($id_chamado);

	   	return  $total['fotos'];

	}

	function nomeFotos($id_chamado){

		$total = Chamado::nomeFotos($id_chamado);

	   	return  $total['nome'];
	}
	

?>