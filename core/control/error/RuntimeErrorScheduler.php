<?php

namespace core\control\error;

use core\tools\designpattern\Singleton;

/**
 * The class RuntimeErrorScheduler is responsible for preparing the Exceptions to be handled
 * @package core\control\error
 */
class RuntimeErrorScheduler implements Singleton{

    /**
     * Self Instance
     * @var RuntimeErrorScheduler
     */
    static private $instance;

    /**
     * Exception handler instance
     * @var ExceptionHandler
     */
    private $handler;

    /**
     * Sets a new ExceptionHandler to deal with the scheduled Exceptions
     * @param ExceptionHandler $handler
     * @return void
     */
    public function setExceptionHandler(ExceptionHandler $handler){
        $this->handler = $handler;
    }

    /**
     * Prepares the environment to deal with exceptions
     * @return void
     */
    public function beginSchedule(){
        // handles the common errors
        set_error_handler(function($code, $message, $file, $line){
            throw new \ErrorException($message, $code, 0, $file, $line);
        });
        // handles the Exceptions that weren't catched
        set_exception_handler(function($e){
            throw new \ErrorException($e->message, $e->type, 0, $e->file, $e->line);
        });
        // deals with the exceptions ate the end of script
        register_shutdown_function(function(){
            $e = error_get_last();
            $scheduler = RuntimeErrorScheduler::getInstance();
            if(!is_null($e)){
                ob_end_clean();
                $e = json_decode(json_encode($e), FALSE);
                try{
                    throw new \ErrorException($e->message, $e->type, 0, $e->file, $e->line);
                } catch(\ErrorException $e){
                    $scheduler->scheduleFatalException($e);
                }
            }
            $scheduler->handleException();
        });
    }

    /**
     * Schedules an exception to handle
     * @param \ErrorException $e
     * @return void
     */
    public function scheduleException(\ErrorException $e){
        $this->handler->setError($e);
    }

    /**
     * Schedules an exception from a fatal error call
     * @param \ErrorException $e
     * @return void
     */
    public function scheduleFatalException(\ErrorException $e){
        $this->handler->setError($e);
        $this->handler->isFatalError();
    }

    /**
     * Gets a self instance
     * @return RuntimeErrorScheduler
     */
    static public function getInstance(){
        if(is_null(self::$instance))
            self::$instance = new RuntimeErrorScheduler();
        return self::$instance;
    }

    /**
     * Handles the exception
     * @return void
     */
    public function handleException(){
        $this->handler->display();
    }

    /**
     * @ignore
     */
    public function __clone(){}
}