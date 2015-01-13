<?php
namespace core\tools\rest;

use core\control\System;
use core\datatypes\JsonObject;

/**
 * Contains Resource class
 * @package core\control\tools\rest
 */
abstract class Resource{

    /**
     * constant GET method selector
     * @var string
     */
    const GET       = "GET";

    /**
     * constant POST method selector
     * @var string
     */
    const POST      = 'POST';

    /**
     * constant PUT method selector
     * @var string
     */
    const PUT       = 'PUT';

    /**
     * constant DELETE method selector
     * @var string
     */
    const DELETE    = 'DELETE';

    /**
     * constant HEAD method selector
     * @var string
     */
    const HEAD      = 'HEAD';

    /**
     * constant OPTIONS method selector
     * @var string
     */
    const OPTIONS   = 'OPTIONS';

    /**
     * Deals with the request to the specified method
     * @param constant $method The method to be handled
     * @return string
     */
    public function answerRequest($method){
        switch($method){
            case self::GET:
                return json_decode(json_encode($_GET), FALSE);
                break;
            case self::POST:
                return json_decode(json_encode($_POST), FALSE);
                break;
            case self::PUT:
                $data = "";
                parse_str(file_get_contents('php://input'), $data);
                return $data;
                break;
            case self::DELETE:
                $data = "";
                parse_str(file_get_contents('php://input'), $data);
                return $data;
                break;
            case self::HEAD:
                return $this->head();
                break;
            case self::OPTIONS:
                return $this->options();
                break;
            default:
                return $this->error();
                break;
        }
    }

    /**
     * @ignore
     */
    protected function head(){
        $options = array(
            'useragent'      => "Firefox (+http://www.firefox.org)", // who am i 
            'connecttimeout' => 120, // timeout on connect 
            'timeout'          => 120, // timeout on response 
            'redirect'          => 10, // stop after 10 redirects
            'referer'           => "http://www.google.com"
        );
        $request = new \HttpRequest(System::getConfig()->baseURL);
        $request->setOptions($options);
        try{
            $request->send();
            return $request->getResponseBody();
        } catch(\HttpException $e){
            $this->error($e->getMessage());
        }
    }

    /**
     * @ignore
     */
    protected function options(){
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers : X-Requested-With, content-type');
        return true;
    }

    /**
     * Returns a success message
     * @param string $msg Message to be shown
     * @return JsonObject
     */
    public function success($msg=null){
        if(is_null($msg)) $msg = 'Operation success';
        return $this->message('success',$msg);
    }

    /**
     * Returns a error message
     * @param string $msg Message to be shown
     * @return JsonObject
     */
    public function error($msg=null){
        if(is_null($msg)) $msg = 'Internal Error';
        return $this->message('error',$msg);
    }

    /**
     * @ignore
     */
    protected function message($type,$msg){
        $json = new JsonObject();
        $json->setKey('type',$type);
        $json->setKey('message',$msg);
        return $json;
    }
}