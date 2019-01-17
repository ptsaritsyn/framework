<?php

/**
 * Created by PhpStorm.
 * Date: 19.10.2016
 * Time: 8:40
 */

namespace Framework\View;

class Render
{
    /**
     * this property is container for view information 
     */
    
    public static $hello = '';
    public static $ready_arr = [];
    public static $id;
    public static $error = '';

    /**
     * this method takes the template and fills view
     * @param $template
     * @return mixed
     */
    public static function view($template)
    {
        ob_start();
        include('../App\Template/'.$template);
        return ob_get_clean();
    }

    public static function bustArray($array)
    {
        foreach ($array as $arr){
            self::$ready_arr[] = $arr;
        }
    }
}
