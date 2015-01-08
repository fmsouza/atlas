<?php
namespace application\src;

use core\control\System;
use core\view\html\GenericElement;
use core\control\tools\rest\RESTful;

/**
 * Application's main class
 * 
 * Method App::main() must always exist.
 *
 * @package application\src
 */
class App{
    
    /**
    * Write here your application's logic
    * @return void
    */
    public static function main(){
        //System::display(GenericElement::layoutInflater("helloMarvie.html"));

        // or maybe you would like to make an API
        // 
        // In this case, just add 'use core\control\tools\rest\RESTful;' in the import section
        // and uncomment the following lines:
        // 
         $rest = new RESTful();
         $rest->serve();
         System::display($rest->getResponse());
        // 
        // and configure the routes controller classes in the 'environment/config.json' file.
    }
}