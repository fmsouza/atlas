<?php
/**
 * Contains CSV class
 * 
 * @copyright Copyright 2013 Marvie
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
	
	namespace system\control\tools;

	/**
	 * Converts array to CSV and works with a CSV file object.
	 * 
	 * @package system\control\tools
	 */
	class CSV{
	    /**
	     * @var string Exported file name
	     */
	    private $fileName;
	    /**
	     * @var int Memory size available to the temporary file
	     */
	    private $memory;
	    /**
	     * @var string Character encoding
	     */
	    private $charset;
	    /**
	     * @var string Stores data about how the file should be sent
	     */
	    private $contentDisposition;
	    /**
	     * @var resource Temporary file buffer
	     */
	    private $buffer;
	    /**
	     * @var array Output data to be saved on the file
	     */
	    private $output;
	    
	    /**
	     * Constructs the object
		 * 
	     * @param string $filename File name
	     * @param $string $charset Character encoding
	     * @param int $memoryAmount Memory size available in MegaBytes
	     * @param string $disposition How to send the output file
	     * @return void
	     */
	    public function __construct($filename, $charset, $memoryAmount = 2, $disposition = 'attachment'){
	        $this->fileName = $filename;
	        $this->charset = $charset;
	        $this->memory = $memoryAmount * 1024 * 1024;
	        $this->contentDisposition = $disposition;
	        $this->open();
	    }
	    
	    /**
	     * Open a new temporary CSV instance
	     * @throws ErrorException
	     */
	    private function open(){
	        try{
	            $this->buffer = fopen("php://temp/maxmemory:".$this->memory, 'r+');
	        }
	        catch(ErrorException $e){
	            $db = debug_backtrace();
	            throw new ErrorException("Não foi possível abrir o arquivo.",$e->getCode(),0,$db[1]['file'],$db[1]['line']);
	        }
	    }
	    
	    /**
	     * Add a new line
	     * @param mixed $data The data to add to the line
	     * @return void
	     */
	    public function addRow($data){
	        $this->output[] = $data;
	    }
	    
	    /**
	     * Writes a full array to the file
	     * @param mixed $data The array to add to file
	     * @return void
	     */
	    public function addAll(array $data){
	        $this->output = $data;
	    }
	    
	    /**
	     * Prepares the header and the data to be sent
		 * 
	     * @return void
	     * @throws ErrorException
	     */
	    private function prepare(){
	        header('Content-Type: text/csv; charset='.$this->charset);
	        header('Content-Disposition: '.$this->contentDisposition.'; filename='.$this->fileName.'.csv');
	        try{
	            foreach ($this->output as $buffer) fputcsv($this->buffer, $buffer);
	            rewind($this->buffer);
	            $this->output = stream_get_contents($this->buffer);
	        }
	        catch(ErrorException $e){
	            $db = debug_backtrace();
	            throw new ErrorException("Error preparing file to be sent.",$e->getCode(),0,$db[1]['file'],$db[1]['line']);
	        }
	    }
	    
	    /**
	     * File output
	     * @return string
		 * @throws ErrorException
	     */
	    public function generate(){
	    	try{
		        $this->prepare();
		        return $this->output;
			}
			catch(ErrorException $e){
	            $db = debug_backtrace();
	            throw new ErrorException("Error in the file output.",$e->getCode(),0,$db[1]['file'],$db[1]['line']);
			}
	    }
	}