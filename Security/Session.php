<?php
/**
 * Created by PhpStorm.
 * Date: 31.10.2016
 * Time: 16:51
 */

namespace Framework\Security;


class Session
{

    /**
     * this method include session
     */

    public static function sessionStart()
    {
        return session_start();
    }

    /**
     * this method set login data in session
     */

    public static function setLoginData()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] = '/login') {
            $_SESSION['login'] = strip_tags($_POST['login']);
            $_SESSION['password'] = strip_tags($_POST['password']);
        }
    }

    /**
     * this method get current session
     * @return array
     */

    public static function getSession()
    {
        return $_SESSION;
    }

    /**
     * this method set new data in current session
     * @param $name
     * @param $value
     */

    public static function setSession($name, $value)
    {
        $_SESSION["$name"] = $value;
    }

    /**
     * this method clean all element current session
     */

    public static function cleanSession()
    {
        return session_destroy();
    }

    /**
     * this method delete current session with id from generate new session id
     */

    public static function deleteSessionId()
    {
        setcookie(session_name(), session_id(), time()-1000);
    }

  
}
