<?php

    namespace system\control\tools\rest;

    use system\control\Core;
    use system\control\datatypes\JsonObject;
    use system\control\tools\rest\Responsibility;

    abstract class Resource implements Responsibility{
            
        protected $successor     = null;
        protected static $method = false;
        protected $request       = false;

        const GET       = "GET";
        const POST      = 'POST';
        const PUT       = 'PUT';
        const DELETE    = 'DELETE';
        const HEAD      = 'HEAD';
        const OPTIONS   = 'OPTIONS';

        public function __construct($request){
            $this->request = $request;
        }
        
        public function answerRequest($method){
            switch($method){
                case self::GET:
                    return $this->get(json_decode(json_encode($_GET), FALSE));
                    break;
                case self::POST:
                    return $this->post(json_decode(json_encode($_POST), FALSE));
                    break;
                case self::PUT:
                    $data = "";
                    parse_str(file_get_contents('php://input'), $data);
                    return $this->put($data);
                    break;
                case self::DELETE:
                    $data = "";
                    parse_str(file_get_contents('php://input'), $data);
                    return $this->delete($data);
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
        
        public function processRequest($request){
            if(!$this->request)
                throw new InvalidArgumentException(Core::$strings->getKey("undefined_service"));
            elseif(!self::$method)
                throw new InvalidArgumentException(Core::$strings->getKey("method_not_set"));
            elseif($request==$this->request)
                return $this->answerRequest(self::$method);
            elseif(!is_null($this->successor))
                return $this->successor->processRequest($request);
            else
                return $this->error();
        }
        
        public static function setMethod($method){
            self::$method = $method;
        }
        
        public static function getMethod(){
            return self::$method;
        }
        
        public function setSuccessor(Responsibility $request){
            $this->successor = $request;
        }
        
        abstract protected function get($data);
        abstract protected function post($data);
        abstract protected function put($data);
        abstract protected function delete($data);
        
        protected function head(){
            $options = array(
                'useragent'      => "Firefox (+http://www.firefox.org)", // who am i 
                'connecttimeout' => 120, // timeout on connect 
                'timeout'          => 120, // timeout on response 
                'redirect'          => 10, // stop after 10 redirects
                'referer'           => "http://www.google.com"
            );
            $request = new HttpRequest(Core::$config->baseURL);
            $request->setOptions($options);
            try{
                $request->send();
                return $r->getResponseBody();
            } catch(HttpException $e){
                $this->error($e->getMessage());
            }
        }
        
        protected function options(){
            header('Access-Control-Allow-Origin : *');
            header('Access-Control-Allow-Methods : POST, GET, OPTIONS, PUT, DELETE');
            header('Access-Control-Allow-Headers : X-Requested-With, content-type');
            return true;
        }
        
        protected function success($msg=null){
            if(is_null($msg)) $msg = Core::$strings->getKey("operation_success");
            return $this->message(Core::$strings->getKey("success"),$msg);
        }
        
        protected function error($msg=null){
            if(is_null($msg)) $msg = Core::$strings->getKey("internal_error");
            return $this->message(Core::$strings->getKey("error"),$msg);
        }
        
        protected function message($type,$msg){
            $json = new JsonObject();
            $json->setKey(Core::$strings->getKey("type"),$type);
            $json->setKey(Core::$strings->getKey("message"),$msg);
            return $json;
        }
    }