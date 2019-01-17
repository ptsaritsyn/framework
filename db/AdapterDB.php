<?php

/**
 * Created by PhpStorm.
 * Date: 26.08.2016
 * Time: 14:39
 */
namespace Framework\DB;


interface AdapterDB
{

    function query($sql);

    function fetch($type);

    function close();
}
