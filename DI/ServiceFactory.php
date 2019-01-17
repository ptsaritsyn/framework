<?php
/**
 * Created by PhpStorm.
 * Date: 28.10.2016
 * Time: 17:26
 */

namespace Framework\DI;

use Framework\Response;

class ServiceFactory
{

    /**
     * this method return object response
     * @return object
     */

    public function response()
    {
        $response = new Response\Response();
        return $response;
    }

    /**
     * this method return object redirect
     * @return object
     */
    
    public function redirect()
    {
        $redirect = new Response\ResponseRedirect();
        return $redirect;
    }

    /**
     * this method check if it service in ServiceFactory
     * @param $service_name
     * @return object
     */

    public function giveService($service_name)
    {
        $rc = new \ReflectionClass($this);
        $method = $rc->hasMethod($service_name);
        
        if($method){
            $rm = new \ReflectionMethod($this, $service_name);
            $result = $rm->invoke($this, $service_name);
            return $result;
        }
        return null;
    }
}
