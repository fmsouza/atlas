<?php
/**
 * Contains Resource class
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

    namespace system\control\tools\rest;

    use system\control\Core;
    use system\control\datatypes\JsonObject;
    use system\control\tools\rest\Responsibility;

    /**
     * Contains Resource class
     * @package system\control\tools\rest
     */
    abstract class Resource implements Responsibility{

        /**
         * @ignore
         */
        protected $successor     = null;

        /**
         * @ignore
         */
        protected static $method = false;

        /**
         * @ignore
         */
        protected $request       = false;

        /**
         * @var constant GET method selector
         */
        const GET       = "GET";

        /**
         * @var constant POST method selector
         */
        const POST      = 'POST';

        /**
         * @var constant PUT method selector
         */
        const PUT       = 'PUT';

        /**
         * @var constant DELETE method selector
         */
        const DELETE    = 'DELETE';

        /**
         * @var constant HEAD method selector
         */
        const HEAD      = 'HEAD';

        /**
         * @var constant OPTIONS method selector
         */
        const OPTIONS   = 'OPTIONS';

        /**
         * @ignore
         */
        public function __construct($request){
            $this->request = $request;
        }

        /**
         * Deals with the request to the specified method
         * @param constant $method The method to be handled
         * @return string
         */
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

        /**
         * Tries to process the request
         * @param string $request The requested route
         * @return string
         */
        public function processRequest($request){
            if(!$this->request)
                throw new InvalidArgumentException('Undefined service');
            elseif(!self::$method)
                throw new InvalidArgumentException('Method not set');
            elseif($request==$this->request)
                return $this->answerRequest(self::$method);
            elseif(!is_null($this->successor))
                return $this->successor->processRequest($request);
            else
                return $this->error();
        }

        /**
         * Set the request method
         * @param string $method The method to be handled
         * @return void
         */
        public static function setMethod($method){
            self::$method = $method;
        }

        /**
         * Returns the request method set
         * @return void
         */
        public static function getMethod(){
            return self::$method;
        }

        /**
         * @ignore
         */
        public function setSuccessor(Responsibility $request){
            $this->successor = $request;
        }

        /**
         * @ignore
         */
        abstract protected function get($data);

        /**
         * @ignore
         */
        abstract protected function post($data);

        /**
         * @ignore
         */
        abstract protected function put($data);

        /**
         * @ignore
         */
        abstract protected function delete($data);

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
            $request = new HttpRequest(Core::$config->baseURL);
            $request->setOptions($options);
            try{
                $request->send();
                return $r->getResponseBody();
            } catch(HttpException $e){
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
        protected function success($msg=null){
            if(is_null($msg)) $msg = 'Operation success';
            return $this->message('success',$msg);
        }

        /**
         * Returns a error message
         * @param string $msg Message to be shown
         * @return JsonObject
         */
        protected function error($msg=null){
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