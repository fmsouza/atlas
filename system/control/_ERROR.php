<?php
/**
* Classe de sistema responsável pelas funções de exibição de erros do sistema.
* @author Julio Cesar (julio@cisi.coppe.ufrj.br)
* 
* @copyright Copyright 2012 COPPE
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* http://www.apache.org/licenses/LICENSE-2.0
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
/**
* Classe de sistema responsável pelas funções de exibição de erros do sistema.
* @package system
* @subpackage control
*/
class _ERROR{
	/**
	* Retorna um array que contém o Stack Trace da exceção lançada.
	* @param exception $e
	* @return array
	*/		
	public static function getStack(exception $e){
		$error = explode("#", $e->getTraceAsString());
		array_shift($error);
		return $error;
	}
	
	/**
	* Renderiza a view com os dados da exceção.
	* @param exception $e
	* @param int $fatal opcional (default: 0)
	* @return string
	*/
	public static function display(exception $e, $fatal=0){
		$layout = GenericElement::layoutInflater("../../system/view/_ERROR_VIEW.html");
		
		if($fatal)
			$end_msg = "Um erro muito grave ocorreu no sistema, verifique-o.";
		else
			$end_msg = "Um erro ocorreu no sistema, verifique-o ou realize o tratamento do mesmo.";
		
		$layout->getElementById("ERROR_TYPE")->getElement(0)->add(new TextElement($end_msg));
		$layout->getElementById("ERROR_MESSAGE")->add(GenericElement::stringInflater("<p>ERRO ".$e->getCode().": ".$e->getMessage()."</p>"));
		$layout->getElementById("ERROR_MESSAGE")->add(GenericElement::stringInflater("<p>Este erro ocoreu na <strong>linha ".$e->getLine()."</strong> do arquivo <strong>".$e->getFile()."</strong></p>"));
		
		foreach(self::getStack($e) as $stackline)
			$layout->getElementById("stackTrace")->add(
				GenericElement::stringInflater("<p>{$stackline}</p>")
			);
		unset($_SESSION["_ERROR"]);
		file_put_contents("php://output", $layout->toRender());
	}
}