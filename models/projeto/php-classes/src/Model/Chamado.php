<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe Chamado(Chamados, com seus métodos específicos)
class Chamado extends Model {

	//Método estático com a query que seleciona  todos dados da tabela tb_chamados e tb_usuarios relacionada pela coluna de id_usuarios em ordem decrescente

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario  ORDER BY b.data_registro DESC");

	}

	
	
	//Método com a query que seleciona dados da tabela tb_chamados e tb_usuarios relacionada pela coluna de id_usuarios em ordem decrescente, passando o id_usuario por parâmetro (Chamados relacionado ao usuário)

	public function getChamadosID($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_usuarios a INNER JOIN tb_chamados b ON a.id_usuario = b.id_usuario WHERE b.id_usuario = :id_usuario ORDER BY b.data_registro DESC
		", [	 

			':id_usuario'=>$id_usuario
		]);
	
	}

	public static function listaChamadosPendentes()	
	{	

		$sql = new Sql();	

		return $sql->select("SELECT * FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario WHERE situacao = 'Pendente' ORDER BY b.data_registro DESC");	

	}	


	//Método estático para selecionar somente os chamados finalizados	
	public static function listaChamadosFinalizados()	
	{	

		$sql = new Sql();	

		return $sql->select("SELECT * FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario WHERE situacao = 'Finalizado' ORDER BY b.data_registro DESC");	

	}


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Chamado();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//Método estático que verifica o total de chamados registrados
	public static function totalChamados()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_chamados");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['chamadosTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	//Método estático que verifica o total de chamados pedentes registrados	
	
	public static function totalChamadosPendentes()	
	{	

		$sql = new Sql();	
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *	
			FROM tb_chamados WHERE situacao = 'Pendente'");	
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");	

		return ['chamadosPendentes'=>(int)$resultTotal[0]["nrtotal"]];	
	}	


	//Método estático que verifica o total de chamados finalizados  registrados	
	public static function totalChamadosFinalizados()	
	{	

		$sql = new Sql();	
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *	
			FROM tb_chamados WHERE situacao = 'Finalizado'");	
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");	

		return ['chamadosFinalizados'=>(int)$resultTotal[0]["nrtotal"]];	
	}

	public static function totalChamadosID($id_usuario)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_chamados WHERE id_usuario = :id_usuario",[
				':id_usuario'=>$id_usuario
				]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['chamadosTotalID'=>(int)$resultTotal[0]["nrtotal"]];
	}

	


	//Método que busca os dados do procedimento e salva no tabela de chamados
	public function registrarChamados()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_chamado(:id_usuario,:problema,:observacao,:situacao)", array(
			":id_usuario"=>$this->getid_usuario(),
			":problema"=>$this->getproblema(),
			":observacao"=>$this->getobservacao(),
			":situacao"=>$this->getsituacao(),
			
		));

		$this->setData($results[0]);

		Chamado::moveFotos();
		

	}

	//Método para atualizar a situação dos chamados
	public function editarSituacao()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_editar_situacao(:id_chamado,:situacao)", [
			':id_chamado'=>$this->getid_chamado(),
			':situacao'=>$this->getsituacao()	
		]);

		$this->setData($results[0]);	

	}



	//Método que seleciona todos chamados passando a ID por parâmetro
	public function get($id_chamado)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_chamados WHERE id_chamado = :id_chamado", [
			':id_chamado'=>$id_chamado
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["id_chamado"]];

	}

	//Método que seleciona todos chamados passando a ID por parâmetro e verificando o valor da situação de cada chamado
	public function valueSituacao($id_chamado)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_chamados WHERE id_chamado = :id_chamado", [
			':id_chamado'=>$id_chamado
		]);

		$this->setData($results[0]);

		return ['value'=>$results[0]["situacao"]];

	}

   
	//Método estático para a verificação do total de fotos de cada chamado
	public static function numFotos($id_chamado)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_chamados_fotos WHERE id_chamado = :id_chamado",[
			':id_chamado'=>$id_chamado
			]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['fotos'=>(int)$resultTotal[0]["nrtotal"]];
	}


	public static function nomeFotos($id_chamado)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_chamados_fotos WHERE id_chamado = :id_chamado", [
			':id_chamado'=>$id_chamado
		]);

		return ['nome'=>$results[0]["nome_foto"]];

	}

	
	
	
	//Método para deletar um chamado
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_chamados WHERE id_chamado = :id_chamado", [
			':id_chamado'=>$this->getid_chamado()
		]);


		 /*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_Chamado" . DIRECTORY_SEPARATOR . 
				$this->getnome_foto();
				unlink($img);*/

	}

	

	//Método para pegar os valores do array
	public function getValues()
	{
		

		$values = parent::getValues();

		return $values;

	}

	//Método para verificar e mover as fotos para  a pasta de destino e seu nome para o banco de dados
	public function moveFotos()
	{
		 				
			$file = isset($_FILES['nome_foto']) ? $_FILES['nome_foto'] : FALSE;

		

			    //loop para ler as imagens
			    for ($cont = 0; $cont < count($file['name']); $cont++){ 


					$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
						"res" . DIRECTORY_SEPARATOR . 
						"ft_chamado" . DIRECTORY_SEPARATOR . 
						
						 $file['name'][$cont];

						$nome_foto = $file['name'][$cont];

					
			   
					    $sql = new Sql();
					    $sql->select("CALL sp_foto_chamado_add(:id_chamado,:id_usuario, :nome_foto)", array(
							":id_chamado"=>$this->getid_chamado(),
							":id_usuario"=>$this->getid_usuario(),
							":nome_foto"=>$nome_foto ));
		      
					    move_uploaded_file($file['tmp_name'][$cont], $directory);

			      }
			
		
	}

	//Método para listar as imagens referentes a cada chamado
	public function showFotos($id_chamado)
	{
	     $sql = new Sql();
	    
	    
	     $resultsExistPhoto = $sql->select("SELECT * FROM tb_chamados_fotos WHERE id_chamado = :id_chamado ", [
	         ':id_chamado'=>$id_chamado
	     ]);

	     $countResultsPhoto = count($resultsExistPhoto);
	     if ($countResultsPhoto > 0)
	     {
	         foreach ($resultsExistPhoto as &$result)
	         {
	             foreach ($result as $key => $value) {
	                 if ($key === "nome_foto") {
	                     $result["foto"] = '/res/ft_chamado/'. $result['nome_foto'];
	                 }
	             }
	         } 

	    
	     
	     return $resultsExistPhoto;
	 	 }
	}
	
	//Método para listar todos as fotos de cada chamado e passar pro parâmetro a ID
	public  function getPhotos($id_foto)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_chamado_fotos WHERE id_foto = :id_foto", [
			':id_foto'=>$id_foto	
		]);	

	}

	//Método para deletar fotos
	public function deletePhoto($id_foto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_chamado_fotos WHERE id_foto = :id_foto", [
			':id_foto'=>$id_foto
		]);

	}

//PAGINAÇÃO DA PÁGINA TODOS CHAMADOS
	public static function getPageAll($page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario  ORDER BY b.data_registro DESC
			LIMIT $start, $itemsPerPage");

		
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA MEUS TODOS CHAMADOS



	public static function getPageSearchAll($search, $page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_chamados b USING(id_usuario)
			WHERE  a.desfunction LIKE :search OR b.observacao LIKE :search OR b.situacao LIKE :search 
			OR b.problema LIKE :search OR a.person LIKE :search OR a.store LIKE :search 
			ORDER BY b.data_registro DESC
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


//PAGINAÇÃO DA PÁGINA TODOS CHAMADOS FINALIZADOS
	public static function getPageChamadosFinalizados($page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario WHERE situacao = 'Finalizado' ORDER BY b.data_registro DESC
			LIMIT $start, $itemsPerPage");

		
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA MEUS TODOS FINALIZADOS

	public static function getPageSearchChamadosFinalizados($search, $page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_chamados b USING(id_usuario)
			WHERE  a.desfunction LIKE :search OR b.observacao LIKE :search OR b.situacao LIKE :search 
			OR b.problema LIKE :search AND b.situacao = 'Finalizado'OR a.person LIKE :search AND b.situacao = 'Finalizado'
			OR a.store LIKE :search AND b.situacao = 'Finalizado'
			ORDER BY b.data_registro DESC
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

	//PAGINAÇÃO DA PÁGINA TODOS CHAMADOS PENDENTES
	public static function getPageChamadosPendentes($page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_usuarios a INNER JOIN  tb_chamados b ON b.id_usuario = a.id_usuario WHERE situacao = 'Pendente' ORDER BY b.data_registro DESC
			LIMIT $start, $itemsPerPage");

		
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA MEUS TODOS PENDENTES

	public static function getPageSearchChamadosPendentes($search, $page = 1, $itemsPerPage = 4)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_chamados b USING(id_usuario)
			WHERE  a.desfunction LIKE :search OR b.observacao LIKE :search OR b.situacao LIKE :search 
			OR b.problema LIKE :search AND b.situacao = 'Pendente'OR a.person LIKE :search AND b.situacao = 'Pendente'
			OR a.store LIKE :search AND b.situacao = 'Pendente'
			ORDER BY b.data_registro DESC
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



}
