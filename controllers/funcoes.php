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

	function totalChamadosID($id_usuario){

		$total = Chamado::totalChamadosID($id_usuario);
	

	   return  $total['chamadosTotalID'];

	}
	
	function totalChamadosPendentes(){

		$total = Chamado::totalChamadosPendentes();

	   return  $total['chamadosPendentes'];

	}


	function totalChamadosFinalizados(){

		$total = Chamado::totalChamadosFinalizados();

	   return  $total['chamadosFinalizados'];
	}

	function numFotos($id_chamado){

		$total = Chamado::numFotos($id_chamado);

	   	return  $total['fotos'];

	}

	function nomeFotos($id_chamado){

		$total = Chamado::nomeFotos($id_chamado);

	   	return  $total['nome'];
	}

	function average(){

		$result = $media['avaliactions'];

		if($result == 0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>" ;
		}
		else if($result <= 0.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else 
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}

	}
	

?>