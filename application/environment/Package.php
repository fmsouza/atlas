<?php
/**
* Classe que armazena os endereços dos pacotes de classes que poderão ser carregados<br />
* Utilize esta classe quando for inserir diretórios dentro de <em>application/src</em>
* @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
* @author Julio Cesar da Silva Pereira (julio@cisi.coppe.ufrj.br)
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
* Classe que armazena os endereços dos pacotes de classes que poderão ser carregados<br />
* Utilize esta classe quando for inserir diretórios dentro de <em>application/src</em>
* @package application
* @subpackage environment
*/
class Package{

    /**
     * Adicione dentro do array de retorno os nomes dos diretórios que estão dentro de application/src
     * @return array
     */
    public static function ALL_PACKS(){
	return array();
    }
}
