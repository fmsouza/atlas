<?php
	/**
     * Esta classe gera um elemento generico html pronto para ser renderizado no browser
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
    /**
	 * Esta classe gera um elemento generico html pronto para ser renderizado no browser
	 * @package system
	 * @subpackage view_HTML
	 */
	class GenericElementsComposition extends ElementsComposition{
		
		/**
		 * Constrói uma composição de elementos genéricos.
		 * @param string $compositionName
		 * @param array $compositionAttributes
		 * @return void
		 */
		public function __construct($compositionName,$compositionAttributes=array()){
			parent::__construct('html');
			$this->elementName = $compositionName;
			$this->elementAttributes = $compositionAttributes;
			$this->elements = array();
			$this->numElements = 0;
			
		}
		
		/**
		 * Este método retorna o nome da composição
		 * @return string
		 */
		public function getCompositionName(){
			return $this->getElementName();
		}
		
		/**
		 * Este método retorna o valor do atributo dado por parâmetro
		 * @param string $key nome do atributo a ser retornado
		 * @return string
		 */
		public function getAttribute($key){
			return (array_key_exists($key, $this->getAttributes()))?$this->elementAttributes[$key]:"";
		}
		
		/**
		 * Este método substitui o nome da composição pelo passado em parâmetro
		 * @param string $name Novo nome para a composição
		 */
		public function setCompositionName($name){
			$this->elementName = $name;
		}
		
		/**
		 * Este método substitui os atributos pelos passado no array em parâmetro
		 * O formato do array deve ser {"nome_atributo" => "valor do atributo"}
		 * @param array $attributes Novo array de atributos para o elemento
		 */
		public function setAttributes($attributes){
			$this->elementAttributes = $attributes;
		}
		
		/**
		 * Este método substitui ou adiciona um atributo dado o nome do atributo e o seu valor
		 * @param string $key Nome do atributo a ser alterado/inserido
		 * @param string $value Valor do atributo
		 */
		public function setAttribute($key,$value){
			$this->elementAttributes[$key] = $value;
		}

		/**
		 * Este método deverá gerar uma string contendo o html referente aos objetos.
		 * @return string
		 */
		public function toRender(){
			$return = "<{$this->getCompositionName()} {$this->attributesToString()}>";
            if($this->getElementCount()>0){
            	foreach($this->getElements() as $element)
                $return .= $element->toRender();
			}
            $return .= "</{$this->getCompositionName()}>";
            return $return;
        }
		
		/**
		 * @ignore
		 */
        static private function getXmlAttributes(SimpleXmlElement $e){
            $return = (array)$e->attributes();
            return !array_key_exists("@attributes",$return) ? array() : $return["@attributes"];
        }
		
		/**
		 * @ignore
		 */
        static private function isSelfXmlClose(SimpleXmlElement $e){
            return count((array)$e)==0 ? true : false;
        }
		
		/**
		 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
		 * @param string $layout
		 * @param integer $index
		 */
        static public function layoutInflater($layout,$index=0){
        	try{
            	$layout = file_get_contents(_USER::VIEW()."/{$layout}");
			}catch(ErrorException $e){
				$db = debug_backtrace();
				throw new ErrorException("failed to open stream("._USER::VIEW()."/{$layout}): No such file or directory",$e->getCode(),0,$db[0]['file'],$db[0]['line']);
			}
			return self::Inflater($layout);
        }
		
		/**
		 * @ignore
		 */
		static private function Inflater($stringXml){
			try{
				$xml = new SimpleXMLElement($stringXml);
	            $GEC = new GenericElementsComposition($xml->getName(),self::getXmlAttributes($xml));
	            foreach($xml as $value){
	               if(count($value)==0){
	                    $GEC->add(
	                        new GenericElement($value->getName(),(string)$value,self::getXmlAttributes($value),!self::isSelfXmlClose($value))
	                    );
	               }else{
	               		$GEC->add(
	               			self::Inflater($value->asXml())
						);
	               }
	            }
	            return $GEC;
			}catch(Exception $e){
				$db = debug_backtrace();
				throw new ErrorException($e->getMessage(),$e->getCode(),0,$db[1]['file'],$db[1]['line']);
			}
		}
		
	}
