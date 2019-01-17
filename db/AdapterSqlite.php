<?php

/**
 * Created by PhpStorm.
 * Date: 26.08.2016
 * Time: 14:40
 */
namespace Framework\DB;


class AdapterSqlite implements AdapterDB
{
    function __construct()
    {
        echo "Database SQLite Connected";
    }

    function  query($sql){}
    
    function  fetch($type){}
    
    function close(){}
}
