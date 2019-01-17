<?php

/**
 * Created by PhpStorm.
 * Date: 14.10.2016
 * Time: 13:28
 */

namespace Framework\DI;

class Service
{
    protected static $service_container = [], $config = [];
    
    /**
     * Service construct
     * @param $config
     */

    public function __construct($config = null)
    {
        self::$config = $config;
    }

    /**
     * this method set service name, assigns object and add to service container
     * @param $service_name
     * @param $instance 
     */

    public static function setService($service_name, $instance)
    {
        self::$service_container["$service_name"] = $instance;
    }
    
    /**
     * this method get service if it in service container, else call method injector
     * @param $service_name
     * @return object 
     */

    public static function getService($service_name)
    {
        if (array_key_exists($service_name, self::$service_container)) {
            return self::$service_container["$service_name"];
            
        } else {
           return self::injector($service_name);
        }
    }
    
    /**
     * this method check, if set service in configuration, return service and add dependency if it,
     * else, search service in ServiceFactory
     * @param $service_name
     * @return object
     */

    public static function injector($service_name)
    {
        foreach (self::$config as $service_conf) {
            if ($service_name == $service_conf['service_name'] && !empty($service_conf['dependency'])) {
                $dependency = $service_conf['dependency'];
                $di = new $dependency();
                $class = $service_conf['class'];
                $service = new $class($di);

                if (!isset(self::$service_container["$service_name"])) {
                    self::$service_container["$service_name"] = $service;
                }
                
                return self::$service_container["$service_name"];

            }

            elseif ($service_name == $service_conf['service_name'] && empty($service_conf['dependency'])
                                                                    && empty($service_conf['params'])) {
                $class = $service_conf['class'];
                $service = new $class();

                if (!isset(self::$service_container["$service_name"])) {
                    self::$service_container["$service_name"] = $service;
                }
                
                return self::$service_container["$service_name"];
            }

            elseif ($service_name == $service_conf['service_name'] && !empty($service_conf['params'])) {
                $class = $service_conf['class'];
                $service = new $class($service_conf['params']);

                if (!isset(self::$service_container["$service_name"])) {
                    self::$service_container["$service_name"] = $service;
                }
                
                return self::$service_container["$service_name"];
            }

            elseif (empty(self::$service_container["$service_name"])) {
                $factory = new ServiceFactory();
                $result = $factory->giveService($service_name);
                self::$service_container["$service_name"] = $result;

                if (is_object($result)) {
                    return self::$service_container["$service_name"];
                }
            }
        }
        return null;
    }
}
