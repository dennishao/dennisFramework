<?php

class Mysql
{
    protected $connect = false;

    private $host="localhost";
    private $username="root";
    private $password="root";
    private $database="test";
    private $charset="utf-8";
    private $port="3306";
    protected $sql;
    public function __construct()
    {
        $this->connect = mysqli_connect($this->host.":". $this->port,$this->username,$this->password,$this->database) or die(mysqli_error());
        $this->setCharset($this->charset);
    }
    protected function setCharset($charset)
    {
        $sql="set names".$charset;
    }
    protected function query($sql)
    {
        $this->sql=$sql;
        $result=mysqli_query($this->connect,$sql);
        if(!$result)
        {
            die("database sql has error".mysqli_connect_error());
        }
        return $result;
    }
    protected function getOne($sql)
    {
        $result=$this->quyey($sql);
        $row=mysqli_fetch_row($result);
        if($row)
        {
            return $row[0];
        }else{
            return false;
        }
    }



}