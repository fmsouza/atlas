<?php
    /**
     * @author Frederico Souza (fredericoamsouza@gmail.com)
     * @author Julio Cesar (thisjulio@gmail.com)
     * 
     * @copyright Copyright 2013 Frederico Souza
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
     * Application's main controller class<br/>
     * Method Main::onExecute() must <em>ALWAYS</em> be defined. It'll always be called.<br/><br/>
     * One of the MVC pillars is the concept of keep markup and logic well separated, in other words,
     * avoid mixing static and dinamic contents. Therefore all the logic content must be written in the
     * controller classes and replaced in the HTML through _HTML class and it's applications.
     *
     * @package application
     * @subpackage src
     */
    class Main extends App{
        /**
        * @ignore
        */
        public $view;
        
        /**
        * Start life cycle
        * @return void
        */
        public function onStart(){
            //User::$emailAdmin="exemplo@email.com";
            Globals::$debug=TRUE; // shows errors in exception screen
            $this->view = GenericElement::layoutInflater("helloMarvie.html");
        }
        
        /**
        * Main execution instructions
        * @return void
        */
        public function onExecute(){
        }
        
        /**
        * Death instructions
        * @return void
        */
        public function onFinish(){
            Main::display($this->view);
            unset($this->view);
        }
    }