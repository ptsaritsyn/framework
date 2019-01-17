<?php
/**
 * Created by PhpStorm.
 * Date: 22.09.2016
 * Time: 13:59
 */

namespace Framework;


class Request
{
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
    * Get method
    * 
    * @return string
    */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get uri
     * 
     * @return string
     */

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get client IP
     * 
     * @return string
     */

    public function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Get script name
     * 
     * @return string
     */

    public function getScriptName()
    {
        return $_SERVER['SCRIPT_NAME'];
    }

    /**
     * is put request
     * 
     * @return bool
     */

    public function isPut()
    {
        return $this->getMethod() == self::METHOD_PUT;
    }

    /**
     * is delete request
     * 
     * @return bool
     */

    public function isDelete()
    {
        return $this->getMethod() == self::METHOD_DELETE;
    }

    /**
     * this method return string for request by GET, if parameter true return request with parameter
     * 
     * @param $id
     * @return array
     */

    public function get($id = null)
    {
        $key = key($_GET);

        preg_match('/\/([a-z0-9]*)(\/?)([a-z0-9]*)(\/?)([a-z0-9]*)(\/?)([a-z0-9]*)/', $key, $pattern);
        $route = '/'.$pattern[3];
        
        if($pattern[5] !=  null) {
            $route = '/'.$pattern[3].'/'.$pattern[5];
        }
        
        if($pattern[7] != null) {
            $route = '/'.$pattern[3].'/'.$pattern[5].'/'.$pattern[7];
        }
        
        if($id == $pattern[3] or $id == $pattern[5] or $id == $pattern[7]){
            return $_GET[$id];
        }

        return $route;
    }

    /**
     * this method return string for request by POST, if parameter true return request with parameter
     * 
     * @param $id
     * @return array
     */

    public function post($id = null)
    {
        if($id != null){
            return $_POST[$id];
        } else {
            return $_POST;
        }
    }

    /**
     * fetch data for request by PUT
     * 
     * @param $id
     * @return array
     */

    public function put($id = null)
    {
        if($this->isPut()){
            return $this->post($id);
        }
            return null;
    }

    /**
     * fetch data for request by DELETE
     * 
     * @param $id
     * @return array
     */

    public function delete($id = null)
    {
        if($this->isDelete()){
            return $this->post($id);
        }
            return null;
    }
}
