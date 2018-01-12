<?php
/*
 * Author dennis <Netherlanddennishao@gmail.com>
 * Version 1.0-test
 * Link_method by mysqli
 */
class Database
{
    /*
     * Create variables to link Mysql database.
     * the variables has been declared private.
     * it means that to enhanced security.
     */
    private $host = "localhost";  //database host_ip or host_url
    private $database = "test";   //database_name
    private $username = "root";   //databse_username
    private $password ="root";            //database_password
    private $port = "3306";       //database_port
    protected $connect;           //database_link
    //function to make connection mysql database
    public function getConnection()
    {

        $this->connect = mysqli_connect($this->host . ":" . $this->port, $this->username, $this->password, $this->database) or die(mysqli_connect_error());

        return $this->connect;
    }

    //function to get data from mysql
    public function getData($table, $row = "*", $where = null, $order = null, $limit = 1)
    {
        $sql = "select " . $row . " from " . $table;
        if ($where != null) {
            $sql .= " where " . $where;
        }
        if ($order != null) {
            $sql .= "order by " . $order;
        }
        $sql .= " limit " . $limit;
        $result = mysqli_query($this->getConnection(), $sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        mysqli_close();
        return $data;
    }

    //function to detele data from mysql
    public function deleteData($table, $data_id = null)
    {
        if (!empty($data_id)) {
            if (count($data_id) == 1) {
                $sql = "delete from " . $table . " where demo1_id= " . $data_id;
                mysqli_query($this->getConnection(), $sql);
            } else {
                foreach ($data_id as $id) {
                    $sql = "delete from " . $table . " where demo1_id= " . $id;
                    mysqli_query($this->getConnection(), $sql);
                }
            }
        }
    }

    //function to insert data to mysql
    public function insertData($table, $data)
    {
        if (!empty($data)) {
            $sql = "insert into $table (" . implode(',', array_keys($data)) . ") VALUES ('" . implode("','", $data) . "')";

            if (mysqli_query($this->getConnection(), $sql)) {
                return true;
            }
            return false;
        }
        return false;
    }

    //functionn to update data from mysql
    public function updateData($table, $data, $id = null)
    {
        if (!empty($data) || !empty($id)) {
            foreach ($data as $k => $v) {
                $up_Data[] = $k . "='" . $v . "'";
            }
            $sql = "UPDATE " . $table . " SET " . implode(",", $up_Data) . " WHERE " . key($id) . "=" . current($id);
            if (mysqli_query($this->getConnection(), $sql)) {
                return true;
            }
            return false;
        }
        return false;
    }

}

$database = new Database();
$database = new Database();
$res = $database->updateData("demo1", array("demo1_name" => "bbb"), array("demo1_id" => 1));
