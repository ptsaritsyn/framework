<?php

/**
 * Created by PhpStorm.
 * Date: 26.08.2016
 * Time: 14:33
 */
namespace Framework;


use Framework\DB\AdapterMysql;
use Framework\DB\AdapterSqlite;
use Framework\DB\AdapterPostgre;



class FactoryAdapter
{

    private static $adapters = [];
    
    /**
     * function return a correctly database
     * @param $name,
     * @param $config
     * @return object
     */

    static public function getConnection($name, $config)
    {
        switch ($name) {
            case 'mysql':
                if (!isset(self::$adapters['mysql'])){
                    self::$adapters['mysql'] = new AdapterMysql($config);
                }
                return self::$adapters['mysql'];
                break;
            case 'sqlite':
                if (!isset(self::$adapters['sqlite'])){
                    self::$adapters['mysql'] = new AdapterSqlite($config);
                }
                return self::$adapters['mysql'];
                break;
            case 'postgres':
                if (!isset(self::$adapters['postgres'])){
                    self::$adapters['postgres'] = new AdapterPostgre($config);
                }
                return self::$adapters['postgres'];
                break;
            default:
                return "This database not found";
        }
    }
}
