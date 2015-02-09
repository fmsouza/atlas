<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 09/02/15
 * Time: 11:55
 */

namespace core\control\file;


class File extends \SplFileObject{

    const MODE_READ                         = 'r';
    const MODE_READ_WRITE                   = 'r+';
    const MODE_WRITE                        = 'w';
    const MODE_WRITE_CREATE                 = 'w+';
    const MODE_APPEND                       = 'a';
    const MODE_READ_WRITE_APPEND            = 'a+';
    const MODE_CREATE_WRITE_TRUNCATE        = 'x';
    const MODE_CREATE_READ_WRITE_TRUNCATE   = 'x+';
    const MODE_CREATE_WRITE                 = 'c';
    const MODE_CREATE_READ_WRITE            = 'c+';

    private $buffer = array();

    public function __construct($fileName, $openMode=self::MODE_READ){
        parent::__construct($fileName, $openMode);
    }

    public function buffer(InputBuffer $buffer){
        $this->buffer = $buffer;
    }

    public function writeLine($data){
        return $this->fwrite($data);
    }

    public function readLine(){
        return $this->fgets();
    }

    public function isEndOfFile(){
        return $this->eof();
    }

    public function flush(){
        $this->fflush();
    }

    public function truncate(){
        $this->ftruncate($this->ftell());
    }

    public function save(){
        $bytes = 0;
        foreach($this->buffer as $buffer){
            $bytes += $this->writeLine($buffer);
        }
        return $bytes;
    }

}