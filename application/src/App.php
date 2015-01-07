<?php
/**
 * Contains App class
 * 
 * @copyright Copyright 2014 Marvie
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
    
    namespace application\src;

    use system\control\Core;
    use system\view\html\GenericElement;
    use system\control\tools\rest\RESTful;

    /**
     * Application's main class
     * 
     * Method App::main() must always exist.
     *
     * @package application\src
     */
    class App{
        
        /**
        * Docblock test
        * @bar='foo';
        * @route(path: 'hello/world', method: 'GET');
        * @test='bla bla';
        */
        public function testMethod(){
            exit("World");
        }
        
        /**
        * Docblock test
        * @foo='bar';
        * @route(path: 'hello/jack', method: 'GET');
        */
        public function anotherMethod(){
            exit("Hello pal!");
        }
        
        /**
        * Write here your application's logic
        * @testing(any: 'some value');
        * @return void
        */
        public static function main(){
            //$ann = new RESTfulAnnotation(new App);
            //$ann->proccess();
            //Core::display(GenericElement::layoutInflater("helloMarvie.html"));

            // or maybe you would like to make an API
            // 
            // In this case, just add 'use system\control\tools\rest\RESTful;' in the import section
            // and uncomment the following lines:
            // 
            $rest = new RESTful();
            $rest->serve();
            Core::display($rest->getResponse());
            // 
            // and configure the routes controllers in the 'environment/config.json' file.
        }
    }