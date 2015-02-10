<?php

namespace core\control\filesystem;

/**
 * Class OutputBuffer encapsulates the buffered data in the file.
 * @package core\control\filesystem
 */
class OutputBuffer {

    /**
     * @ignore
     */
    private $file;

    /**
     * Starts the buffer.
     * @param File $f The file to worked on
     * @return OutputBuffer
     */
    public function __construct(File $f){
        $this->file = $f;
    }

    /**
     * Gets all the lines in the given file.
     * @return array
     */
    public function readAll(){
        $tmp = array();
        while(!$this->file->isEndOfFile()){
            $this->file->next();
            $tmp[] = $this->file->current();
        }
        return $tmp;
    }
}