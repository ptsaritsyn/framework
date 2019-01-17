<?php
/**
 * Created by PhpStorm.
 * Date: 16.08.2016
 * Time: 9:29
 */

namespace Framework;


use Framework\DI\Service;
use Framework\Response\Response;
use Framework\View\Render;

class App
{
    /**
     * @var array config
     */

    private $config = [];
    public $services, $response;
    public $session;

    /** 
     * this method takes a array  configuration,
     * App constructor
     * @param $config
     */

    public function __construct($config = null)
    {
        $this->config = $config;
        $this->services = new Service($this->config['services']);
        $this->response = Service::getService('response');
    }

    /**
     * this method dynamically add new configuration
     * @param $pattern
     * @param $class
     * @param $action
     * @param $params
     */

    public function addConfig($pattern, $class, $action, $params)
    {
        $build = Router::getInstance($this->config['routes']);
        $build->configBuilder($pattern, $class, $action, $params);
    }
    
    /**
     * this method create Controller and call it action with reflection,
     */

    public function run()
    {
        $routing_map = $this->config['routes'];
        $route = Router::getInstance($routing_map);
        $route->getRoute();
        if(class_exists($route->getController())){
            $front = new \ReflectionClass($route->getController());

            if($front->hasMethod($route->getAction())){
                $class = $front->newInstance();
                $method = $front->getMethod($route->getAction());
                $response = $method->invoke($class,$route->getParams());
                if($response instanceof Response){
                    $response->send();
                }
            }
            
        } else {
            $buffer = Render::view('not_found.template.php');
            return $this->response->add($buffer, 404);
        }
    }
}
