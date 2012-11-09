<?php
	/**
     * 
     * Classe DataGrid
     * 
     * Esta classe gera um elemento do tipo table html com dados passados pelo desenvolvedor pronto para ser renderizado no browser
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method setInitLine
     * @method setNumColumns
	 * @method setData
	 * @method preRender
     * @method layoutInflater
     * 
     */
     
	class DataGrid extends GenericElementsComposition{
		private $initLine;
		private $data;
		private $numColumns;
		
		public function __construct($compositionAttributes=array()){
			parent::__construct("table",$compositionAttributes);
		}
		
		/**
		 * Este método seta a linha inicial para começar a preencher a table
		 * @param integer $line
		 */
		public function setInitLine($line){
			$this->initLine = $line;
		}
		
		/**
		 * Este método seta o número de colunas do layout da tabela
		 * @param integer $numColumns
		 */
		public function setNumColumns($numColumns){
			$this->numColumns = $numColumns;
		}
		
		/**
		 * Este método seta os dados que vão preencher a tabela
		 * @param array $data
		 */
		public function setData($data){
			$this->data = $data;
		}
		
		/**
		 * Prepara o objeto para ser renderizado
		 * @param array $trAttributes
		 * @param array $tdAttributes
		 * @return DataGrid Retorna o próprio objeto para renderização
		 */
		public function preRender($trAttributes=array(),$tdAttributes=array()){
			$isFirst = TRUE;
			foreach($this->data as $dline){
				if(count($dline)==$this->getElement($this->initLine)->getElementCount()){
					if($isFirst){
						$j=0;
						$this->getElement($this->initLine)->setAttributes($trAttributes);
						foreach($dline as $dcol){
							if(!$this->getElement($this->initLine)->getElement($j)->getClose())
								throw new Exception("Erro na construção do HTML: valor de <td> base não pode ser vazio.");
							$this->getElement($this->initLine)->getElement($j)->setValue($dcol);
							$this->getElement($this->initLine)->getElement($j)->setAttributes($tdAttributes);
							$j++;
						}
						$isFirst=FALSE;
					}else{
						$tr = new GenericElementsComposition("tr",$trAttributes);
						foreach($dline as $dcol){
							$tr->add(new GenericElement('td',$tdAttributes,$dcol,TRUE));
						}
						$this->add($tr);
					}
				}
			}
			return $this;
		}
		
		/**
		 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
		 * @param string $layout
		 * @param integer $initLine
		 * @param integer $index
		 */
		public static function layoutInflater($layout,$initLine,$index=0){
			$datagrid = new DataGrid();
			$base = GenericElementsComposition::layoutInflater($layout);
			$datagrid->setInitLine($initLine);
			$datagrid->setNumColumns($base->getElement($initLine)->getElementCount());
			foreach($base->getElements() as $element)
				$datagrid->add($element);
			return $datagrid;
		}
	}
	