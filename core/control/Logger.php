<?php

namespace core\control;


class Logger {

    const INFO      = 'INFO';
    const ERROR     = 'ERROR';
    const FATAL     = 'FATAL';
    const WARNING   = 'WARNING';

    private static $logFile = "atlas.log";

    public static function log($LEVEL, $CLASS, $MESSAGE){
        $is = new InputBuffer();
        $is->addLine("[{$LEVEL}] {$CLASS}: $MESSAGE");
        $file = new File(self::$logFile);
        $file->buffer($is);
        $file->save();
    }

}