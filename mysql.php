<?php
define('MYSQL_HOST', 'localhost');
define('MYSQL_USERNAME', 'php');
define('MYSQL_PASSWORD', 'php');
define('MYSQL_DATABASE', 'php_crud');

class Mysql
{
    public function __construct()
    {
        $this->mysql = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

        if ($this->mysql->connect_error) {
            $this->sendError($this->mysql->connect_error);
        }
    }
    public function create($firstname, $lastname)
    {
        $query = $this->mysql->query("INSERT INTO person (firstname,lastname) VALUES ('$firstname','$lastname')");
        if (!$query) {
            return $this->sendError($this->mysql->error);
        } else {
            return $query;
        }
    }
    public function createID()
    {
        return $this->mysql->insert_id;
    }
    public function fetch()
    {
        $this->query = $this->mysql->query("SELECT * FROM person");
        if (!$this->query) {
            return $this->sendError($this->mysql->error);
        } else {
            return $this;
        }
    }
    public function num_rows()
    {
        return $this->query->num_rows;
    }
    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }
    public function find($id)
    {
        $query = $this->mysql->query("SELECT * FROM person WHERE id='$id' LIMIT 1");
        if (!$query) {
            return $this->sendError($this->mysql->error);
        } else {
            return $query->fetch_assoc();
        }
    }
    public function update($id, $firstname, $lastname)
    {
        $query = $this->mysql->query("UPDATE person SET firstname='$firstname',lastname='$lastname' WHERE id='$id'");
        if (!$query) {
            return $this->sendError($this->mysql->error);
        } else {
            return $query;
        }
    }
    public function delete($id)
    {
        $query = $this->mysql->query("DELETE FROM person WHERE id='$id'");
        if (!$query) {
            return $this->sendError($this->mysql->error);
        } else {
            return $query;
        }
    }
    public function sendError($error)
    {
        die("Error : " . $error);
    }
}
