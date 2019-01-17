<?php

/**
 * Created by PhpStorm.
 * Date: 26.08.2016
 * Time: 14:40
 */
namespace Framework\DB;


class AdapterPostgre implements AdapterDB
{

    function __construct()
    {
        echo "Database Postgres Connected";
    }

    function  query($sql){}
    
    function  fetch($type){}
    
    function close(){}
}
