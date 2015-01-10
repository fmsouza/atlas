<?php

namespace core\control\tools;

use core\control\error\SessionException;
use core\control\tools\designpattern\Singleton;

/**
 * Session class deals with session specific functions.
 * @package core\control
 * @abstract
 */
class Session implements Singleton{

    /**
     * Session status
     * @var bool
     */
    protected $sessionStatus;

    /**
     * Session data
     * @var array
     */
    protected $sessionData;

    /**
     * Self Instance
     * @var Session
     */
    static private $instance;

    /**
     * @ignore
     */
    private function __construct(){
        $this->recoverSession();
    }

    /**
     * Verifies if the session is opened or not
     * @return boolean
     */
    public function getSessionStatus(){
        return (bool)$this->sessionStatus;
    }

    /**
     * Open the session
     * @return void
     */
    public function openSession(){
        if(!$this->getSessionStatus()){
            $this->sessionStatus = 1;
            $_SESSION[get_class()]['sessionStatus'] = 1;
            $_SESSION[get_class()]['data'] = array();
        }
    }

    /**
     * Closes the session
     * @return void
     */
    public function closeSession(){
        if($this->getSessionStatus()){
            session_destroy();
            $this->sessionStatus = 0;
            unset($this->sessionData);
        }
    }

    /**
     * Returns some data stored in session
     * @param string $key
     * @return string
     * @throws SessionException
     */
    public function getSessionData($key){
        if($this->getSessionStatus()){
            try{
                return base64_decode($this->sessionData[$key]);
            }catch(\ErrorException $e){
                $db = debug_backtrace();
                throw new SessionException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
            }
        }
    }

    /**
     * Returns all the application data stored in session
     * @return array
     */
    public function getSession(){
        return $this->sessionData;
    }

    /**
     * @ignore
     */
    private function fillSessionData(){
        if($this->getSessionStatus() && isset($_SESSION['application']['data'])){
            $this->sessionData = $_SESSION[get_class()]['data'];
        }
    }

    /**
     * Add/update the data set in session
     * @param string $key nome do campo
     * @param mixed $value dado a ser armazenado
     * @return void
     */
    public function addToSessionData($key,$value){
        if($this->getSessionStatus()){
            $this->sessionData[$key] = base64_encode($value);
        }
    }

    /**
     * Recover last execution's session if set
     * @return void
     */
    private function recoverSession(){
        if(isset($_SESSION[get_class()])){
            $this->sessionStatus = 1;
            $this->fillSessionData();
        }else
            $this->sessionStatus = 0;
    }

    /**
     * Get global data in the session
     * @return mixed
     */
    public function getGlobal($key){
        return $this->getSessionData("globals")->getKey($key);
    }

    /**
     * Updates PHP session with the application session data
     * @return void
     */
    private function writeSessionData(){
        if($this->getSessionStatus()){
            $_SESSION['application']['data'] = $this->sessionData;
        }
    }

    /**
     * @ignore
     */
    static public function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Session();
        }
        return self::$instance;
    }

    /**
     * @ignore
     */
    public function __clone(){}


    /**
     * @ignore
     */
    public function __destruct(){
        $this->writeSessionData();
        self::$instance = NULL;
    }
}