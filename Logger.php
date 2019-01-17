<?php
/**
 * Created by PhpStorm.
 * Date: 11.12.2016
 * Time: 16:27
 */

namespace Framework;

class Logger
{
    /**
     * this method write log if wrong password
     * @param $file_name
     * @param $message
     */

    public static function passwordError($file_name, $message)
    {
        file_put_contents($file_name, date('r').": $message\n".
            $_SERVER['HTTP_USER_AGENT'].' '.$_SERVER['REMOTE_ADDR'].
            "\n-------------------------------\n", FILE_APPEND);
    }
}
