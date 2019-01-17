<?php

/**
 * Created by PhpStorm.
 * Date: 26.08.2016
 * Time: 14:39
 */
namespace Framework\DB;


class AdapterMysql implements AdapterDB
{
    private $db;
    protected $sql, $query;

    /**
     * this construct AdapterMysql connect with database
     * @param $config
     * @return mixed
     */


    public function  __construct($config){
            $this->db = new \mysqli($config['db']['host'],$config['db']['user'],
                                    $config['db']['password'],$config['db']['db_name']);
        if(!$this->db){
          return $this->db->error;
        } else {
            return true;
        }

    }

    /**
     * this method query the database
     * @param $sql
     * @return mixed
     */

    public function query($sql){
            $this->sql = $sql;
            return $this->db->query($sql);
    }

    /**
     * this method select all the rows from the result set by type
     * @param $type
     * @param $const
     * @return array
     */

    public function fetch($type, $const = MYSQLI_ASSOC){
        switch ($type){
            case 'index': return $this->db->query($this->sql)->fetch_row();
            break;
            case 'assoc': return $this->db->query($this->sql)->fetch_assoc();
            break;
            case 'all': return $this->db->query($this->sql)->fetch_all($const);
            break;
            default: return "Input not correctly";
        }

    }

    /**
     * this method prepares a SQL statement for execution
     * @param $query
     * @return object
     */

    public function prepare($query)
    {
        $this->query = $query;
        return $this->db->prepare($query);
    }

    /**
     * this method bind variables to parameters
     * @param $str
     * @param $mixed_var
     * @return bool
     */

    public function bind($str, $mixed_var)
    {
        $stmt = $this->prepare($this->query);
        return $stmt->bind_param($str, $mixed_var);
    }

    /**
     * this method executes the prepared statement
     * @return bool
     */

    public function exec()
    {
        $stmt = $this->prepare($this->query);
        return $stmt->execute();
    }

    /**
     * this method screening string for insert data to db
     * @param $string
     * @return string
     */

    public function escape($string)
    {
        return $this->db->escape_string($string);
    }

    /**
     * this method Returns the description of the last error
     * @return string
     */

    public function error()
    {
        return $this->db->error;
    }

    /**
     * this method close connection
     * @return bool
     */

    public function close()
    {
       return $this->db->close();
    }
}
