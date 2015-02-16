<?php

namespace core\control;

use core\control\filesystem\File;
use core\control\filesystem\InputBuffer;
use core\control\filesystem\IOException;

/**
 * Class Logger provides an interface to make application logging.
 * @package core\control
 */
class Logger {

    /**
     * Information-level log flag
     */
    const INFO      = 'INFO';

    /**
     * Error-level log flag
     */
    const ERROR     = 'ERROR';

    /**
     * Fatal-level log flag
     */
    const FATAL     = 'FATAL';

    /**
     * Warning-level log flag
     */
    const WARNING   = 'WARNING';

    /**
     * @ignore
     */
    private function __construct(){}

    /**
     * Creates a log record
     * @param $LEVEL string Level of the log record message
     * @param $CLASS string Class where the notice happened
     * @param $MESSAGE string Message to be written in the log
     * @param $FILE string File to write the data
     * @throws IOException
     */
    public static function log($LEVEL, $CLASS, $MESSAGE, $FILE="atlas.log"){
        $is = new InputBuffer();
        $is->add("[{$LEVEL}] {$CLASS}: $MESSAGE");
        try{
            $file = new File($FILE);
            $file->readBuffer($is);
            $file->save();

        } catch(\RuntimeException $e){
            $db = debug_backtrace();
            throw new IOException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
        }
    }

}