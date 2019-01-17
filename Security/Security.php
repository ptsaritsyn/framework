<?php
/**
 * Created by PhpStorm.
 * Date: 31.10.2016
 * Time: 18:27
 */

namespace Framework\Security;

use Framework\Exception\ExceptionLogin;

class Security
{
    const FILE_LOGIN = "../vendor/framework/Security/.htpasswd";
    
    /**
     * this method get hash from password
     * @param $password
     * @return string 
     */
    
    public function hashPassword($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }

    /**
     * this method check password with hash and throw Exception if result not true
     * @throws ExceptionLogin
     * @param $password
     * @param $hash
     * @return bool
     */

    public function checkPassword($password, $hash)
    {
       $verify = password_verify(trim($password), trim($hash));
        
        if(!$verify){
            throw new ExceptionLogin('Incorrect username or password');
        }
        return $verify;
    }

    /**
     * this method save user in passwords file 
     * @param $login
     * @param $hash
     * @return bool
     */
    
    public function saveUser($login, $hash)
    {
        $data = "$login:$hash\n";
        
        if(file_put_contents(self::FILE_LOGIN, $data, FILE_APPEND)){
            return true;
        }

    }

    /**
     * this method check if user set return user 
     * @param $login
     * @return string
     * @throws 
     */

    public function checkUser($login)
    {
        $users = file(self::FILE_LOGIN);
        
        foreach ($users as $user){
            if(strpos($user, $login) !== false){
                return $user;
            } else {
                continue;
            }
        }

        throw new ExceptionLogin('Incorrect username or password');
    }
}
