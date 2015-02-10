<?php

namespace core\control\filesystem;

/**
 * Class File offers an object oriented interface for a file
 * @package core\control\filesystem
 */
class File extends \SplFileObject{

    /**
     * Open for reading only; place the file pointer at the beginning of the file.
     */
    const MODE_READ                         = 'r';

    /**
     * Open for reading and writing; place the file pointer at the beginning of the file.
     */
    const MODE_READ_WRITE                   = 'r+';

    /**
     * Open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it.
     */
    const MODE_WRITE                        = 'w';

    /**
     * Open for reading and writing; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it.
     */
    const MODE_WRITE_CREATE                 = 'w+';

    /**
     * Open for writing only; place the file pointer at the end of the file. If the file does not exist, attempt to create it.
     */
    const MODE_APPEND                       = 'a';

    /**
     * Open for reading and writing; place the file pointer at the end of the file. If the file does not exist, attempt to create it.
     */
    const MODE_READ_WRITE_APPEND            = 'a+';

    /**
     * Create and open for writing only; place the file pointer at the beginning of the file. If the file already exists, the fopen() call will fail by returning FALSE and generating an error of level E_WARNING. If the file does not exist, attempt to create it. This is equivalent to specifying O_EXCL|O_CREAT flags for the underlying open(2) system call.
     */
    const MODE_CREATE_WRITE_TRUNCATE        = 'x';

    /**
     * Create and open for reading and writing; otherwise it has the same behavior as 'MODE_CREATE_WRITE_TRUNCATE'.
     */
    const MODE_CREATE_READ_WRITE_TRUNCATE   = 'x+';

    /**
     * Open the file for writing only. If the file does not exist, it is created.
     * If it exists, it is neither truncated, nor the call to this function fails.
     * The file pointer is positioned on the beginning of the file. This may be useful
     * if it's desired to get an advisory lock before attempting to modify the file,
     * as using 'MODE_WRITE' could truncate the file before the lock was obtained.
     */
    const MODE_CREATE_WRITE                 = 'c';

    /**
     * Open the file for reading and writing; otherwise it has the same behavior as 'MODE_CREATE_WRITE'.
     */
    const MODE_CREATE_READ_WRITE            = 'c+';

    /**
     * @ignore
     */
    private $inputBuffer;

    /**
     * @param $fileName The file to read
     * @param string $openMode The mode in which to open the file
     * @throws FileNotFoundException
     * @throws \RuntimeException
     * @return File
     */
    public function __construct($fileName, $openMode=self::MODE_READ){
        if(!file_exists($fileName)) throw new FileNotFoundException("'$fileName' not found.");
        parent::__construct($fileName, $openMode);
        $this->prepareBuffer();
    }

    private function prepareBuffer(){
        if($this->count()>0){
            $ib = new InputBuffer();
            while(!$this->isEndOfFile()){
                $ib->add($this->readLine());
            }
            $this->seek(0);
            $this->inputBuffer = $ib;
        }
    }

    /**
     * Load data from a Buffer object
     * @param InputBuffer $buffer Object with the buffer to be loaded to the file
     * return void
     */
    public function readBuffer(InputBuffer $buffer){
        if(is_null($this->inputBuffer)){
            $this->inputBuffer = $buffer;
        } else {

        }
    }

    /**
     * Write a line to the file
     * @param $data string The line data
     * @return int
     */
    public function writeLine($data){
        return $this->fwrite($data);
    }

    /**
     * Reads a line
     * @return string
     */
    public function readLine(){
        return $this->fgets();
    }

    /**
     * Number of lines in the file
     * @return int
     */
    public function count(){
        $tmp = $this->key();
        $this->seek(PHP_INT_MAX);
        $lines = $this->key();
        $this->seek($tmp);
        return $lines;
    }

    /**
     * Verifies if the pointer is in the end of the file
     * @return bool
     */
    public function isEndOfFile(){
        return $this->eof();
    }

    /**
     * Forces a write of all buffered output to the file.
     * @return void
     */
    public function flush(){
        $this->fflush();
    }

    /**
     * Truncates the file to $size bytes.
     * @param int $size The size to truncate to.
     * @return void
     */
    public function truncate($size){
        $this->ftruncate($size);
    }

    /**
     * Returns the position of the file pointer which represents the current offset in the file stream.
     * @return int
     */
    public function getPointerPosition(){
        return $this->ftell();
    }

    /**
     * Saves the buffer to the file and returns the number of bytes written.
     * @return int
     */
    public function save(){
        $bytes = 0;
        foreach($this->inputBuffer as $buffer){
            $bytes += $this->writeLine($buffer);
        }
        $this->flush();
        $this->truncate($this->getPointerPosition());
        return $bytes;
    }

}