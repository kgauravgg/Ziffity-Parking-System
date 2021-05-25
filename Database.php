<?php

class Database {
    public $hostname = "http://localhost/PhpOopCrud";
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "ziffity_parking";

    private $conn = false;
    private $mysqli = "";
    private $result = array();

    public function __construct(){
        if(!$this->conn){
            $this->mysqli = new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_pass,
                $this->db_name
            );
            $this->conn = true;
            if($this->mysqli->connect_error){
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    public function insert($table, $data=array()){
        if($this->tableExists($table)){
            $table_columns = implode(', ', array_keys($data));
            $table_values = implode("', '", $data);
            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_values')";
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($table, $data=array(), $updateField=null, $value=null, $where=null){
        if($this->tableExists($table)){
            $args = array();
            foreach($data as $key=>$value){
                $args[] = "$key = '$value'";
            }
            $sql = "UPDATE $table SET ". implode(', ', $args);
            if($where != null) {
                $sql .= " WHERE $where"; 
            }
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateValueToExisting($table, $colunName=null, $paymentType, $value=null, $where=null){
        if($this->tableExists($table)){
            $sql = "UPDATE $table SET $colunName=$colunName$paymentType$value";
            if($where != null) {
                $sql .= " WHERE $where"; 
            }
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($table, $where=null){
        if($this->tableExists($table)){
            $sql = "DELETE FROM $table";
            if($where !=null){
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function select($table, $rows="*", $join = null, $where=null, $order=null, $limit=null){
        if($this->tableExists($table)){ 
            $sql = "SELECT $rows FROM $table";
            if($join != null){
                $sql .= " JOIN $join";
            }
            if($where != null){
                $sql .= " WHERE $where";
            }
            if($order != null){
                $sql .= " ORDER BY $order";
            }
            if($limit != null){
                $sql .= " LIMIT 0,$limit";
            }
            $this->selectAll($sql);
        } else {
            return false;
        }
    }

    public function selectAll($sql){
        $query = $this->mysqli->query($sql);
        if($query){
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }
    
    private function tableExists($table) {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if($tableInDb){
            if($tableInDb->num_rows == 1) {
                return true;
            }else {
                array_push($this->result, $table." does not exists in database");
                return false;
            }
        } 
    }

    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function __destruct(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
?>