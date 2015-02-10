<?php

namespace core\control\filesystem;

/**
 * Class InputBuffer offers an encapsulation for the data to write in a file
 * @package core\control\filesystem
 */
class InputBuffer implements \Iterator{

    private $index;

    /**
     * @ignore
     */
    private $buffer = array();

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
     * @param array $arr List of lines
     */
    public function addArray(array $arr){
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
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current(){
        return $this->buffer[$this->index];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next(){
        $this->index++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key(){
        return $this->index;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid(){
        return isset($this->buffer[$this->key()]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind(){
        $this->index = 0;
    }
}