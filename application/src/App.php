<?php
namespace application\src;

use core\control\System;
use core\tools\rest\Resource;
use core\tools\rest\RESTful;
use core\tools\rest\RESTfulAnnotation;
use core\view\html\GenericElement;

/**
 * Application's main class
 * Method App::main() must always exist.
 * @package application\src
 */
class App extends Resource{
    
    /**
    * Write here your application's logic
    * @return void
    */
    public static function main(){
        $rest = new RESTful(array('application.src.TestResource'));
        $rest->serve();
        System::display($rest->getResponse());

        //System::display(GenericElement::layoutInflater("helloMarvie.html"));

    }
}