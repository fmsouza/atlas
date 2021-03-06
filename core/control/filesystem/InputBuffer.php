<?php

namespace core\control\filesystem;

/**
 * Class InputBuffer offers an encapsulation for the data to write in a file
 * @package core\control\filesystem
 */
class InputBuffer extends Buffer{

    /**
     * @ignore
     */
    private $bytes = 0;

    /**
     * Adds a line to the end of file
     * @param $text string The line content
     * @return void
     */
    public function add($text){
        $this->buffer[] = $text;
        $this->bytes += strlen($text);
    }

    /**
     * Override the list of lines to write.
     * @param \Iterator $arr List of lines
     */
    public function addArray(\Iterator $arr){
        foreach($arr as $a){
            $this->add($a);
        }
    }

    public function getAll(){
        return $this->buffer;
    }

    /**
     * Clears the buffer
     */
    public function clear(){
        $this->buffer = [];
        $this->bytes = 0;
    }

    /**
     * Removes a line from the buffer
     * @param int $index index of the line in the buffer
     */
    public function removeLine($index){
        $bytes = strlen($this->buffer[$index]);
        unset($this->buffer[$index]);
        $this->bytes -= $bytes;
        $this->buffer = array_values($this->buffer);
    }

    /**
     * Count the number of lines in the buffer.
     * @return int
     */
    public function lines(){
        return count($this->buffer);
    }

    /**
     * Count the number of bytes in the buffer.
     * @return int
     */
    public function bytes(){
        return $this->bytes;
    }

    /**
     * Merges a buffer object to the current buffer
     * @param Buffer $buffer
     */
    public function mergeBuffer(Buffer $buffer){
        $this->addArray($buffer);
    }
}