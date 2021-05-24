<?php 

namespace Projeto;

use \Rain\Tpl;
use \Projeto\Model\Usuario;

//Classe Page(Página, com os principais métodos de templates usado para a página de usuários comuns)
class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>["dir_url" => "https://www.smart-suport.com.br/"  // variável
		]

	];

	//Método Construtor para redirecionar as páginas do diretório views 
	public function __construct($opts = array(),$tpl_dir = "/views/")
	{

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
		    "base_url"      => null,
		    "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
		    "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
		    "auto_escape"   => false,
		    "debug"         => true
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl();

		//atribuindo os valores das váriaveis do Usuario na sessão.
		if (isset($_SESSION[Usuario::SESSION])) $this->tpl->assign("usuario", $_SESSION[Usuario::SESSION]);
		
		if ($this->options['data']) $this->setData($this->options['data']);

		if ($this->options['header'] === true) $this->tpl->draw("header", false);

	}


	public function __destruct()
	{

		if ($this->options['footer'] === true) $this->tpl->draw("footer", false);

	}

	private function setData($data = array())
	{

		foreach($data as $key => $val)
		{

			$this->tpl->assign($key, $val);

		}

	}

	//Método para renderização do template com parâmetro do nome da página html e seus dados ou chamadas de métodos, se houver.
	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($tplname, $returnHTML);

	}

}

 ?>