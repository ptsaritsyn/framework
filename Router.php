<?php
/**
 * Created by PhpStorm.
 * Date: 28.08.2016
 * Time: 10:33
 */

namespace Framework;


    class Router
    {
        private static $route;
        protected $controller, $action, $params, $router, $routing_map;
        
        public static function getInstance($routing_map = null)
        {
            if (!(self::$route instanceof self)){
                self::$route = new self($routing_map);
            }
                return self::$route;
        }

        /**
         * Router constructor
         * function initialize routing
         * @param $routing_map
         */

        private function __construct($routing_map = null)
        {
            $this->routing_map = $routing_map;
        }
        
         /**
         * cloning ban for singleton
         */
        private function __clone(){}

        /**
         * this method add new configuration
         * @param $pattern
         * @param $class
         * @param $action
         * @param $params
         */
       public function configBuilder($pattern, $class, $action, $params)
        {
            $build = ['pattern' => $pattern,
                        'class' => $class,
                        'action' => $action,
                        'params' => $params];
            $this->routing_map[] = $build;
        }

        /**
         * this method build url
         * @param $link
         * @param $params
         * @return string
         */
        public function uriBuilder($link, $params = []){
            $key = key($params);

            if($params) {
                $query = $link . '/' . $params[$key];
                return $query;

            } else {
                return $link;
            }
        }

        /** 
         * this method create routing
         */
       
        public function getRoute()
        {
            $query = $_SERVER['REQUEST_URI'];
            $link = explode('/', $query);
            $pattern = '/' . $link[1];
            foreach ($this->routing_map as $map){

                if($pattern == $map['pattern']){
                    $this->controller = $map['class'];
                    $this->action = $link[2].'Action';
                    if ($link[3] !== null) {
                         $this->params = $link[3];
                        }
                    }

                if($pattern == $map['pattern'] and $link[2] == null and $link[3] == null){
                        $this->controller = $map['class'];
                        $this->action = $map['action'];
                }
            }
        }

        public function getController()
        {
            return $this->controller;
        }

        public function getAction()
        {
            return $this->action;
        }

        public function getParams()
        {
            return $this->params;
        }


    }

