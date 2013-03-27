<?php
/**
 * Interface que permite o padrão inflater nos objetos
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
 * Interface que permite o padrão inflater nos objetos
 * @package system
 * @subpackage view_HTML
 */
interface Inflater{
    /**
     * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
     * @param string $layout
     * @param integer $index
     * @return void
     */
    static public function layoutInflater($layout,$index=0);
}
