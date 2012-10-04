<?php if(!class_exists('View')):

/**
 * Classe View
 * 
 * Classe que possui todas as definições e métodos padrões de montagem da interface
 * 
 * @author Frederico Souza
 * 
 * @method load(string $file)
 * @method arg(string[] $values)
 * @method render(string $args)
 *
 */
class View{
	
	private $layout;
	private $delini = '::';
	private $delfin = '::';
	private $ext = '.html';
	
	/**
	 * 
	 * Verifica se foram passados os parâmetros e os atribui à classe caso positivo
	 * 
	 * @param string $delini
	 * @param string $delfin
	 * @param string $ext
	 */
	function __construct($delini='',$delfin='',$ext=''){
		if(!empty($delini)) $this->delini = $delini;
		if(!empty($delfin)) $this->delfin = $delfin;
		if(!empty($ext)) $this->ext = $ext;
	}
	
	/**
	 * 
	 * Carrega um arquivo para dentro da classe
	 * @param string $file
	 */
	public function load($file){
			$this->layout .= file_get_contents(APP_PATH."/views/".$file.$this->ext);
	}
	
	/**
	 * 
	 * Carrega os valores em seus respectivos lugares na página
	 * @param string[] $values
	 */
	public function arg($values){
		foreach($values as $foo => $bar)
			$this->layout = str_replace($this->delini.$foo.$this->delfin,$bar,$this->layout);
	}
	
	/**
	 * 
	 * Renderiza a página
	 * @param string[] $args
	 */
	public function render($args=array()){
		if(!empty($args)) $this->arg($args);
		echo $this->layout;
	}
	
}

endif;

// Fim do arquivo view.php