<?php

class Model {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "sljp";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
    }

    public function query($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        if ($params && $types) { 
            $stmt->bind_param($types, ...$params);
        }

        $result = $stmt->execute();
        if ($result === false) {
        } else {
            if (str_starts_with(strtoupper($sql), "SELECT")) {
                $result = $stmt->get_result();
            }
        }
        $stmt->close();
        return $result;
    }

    public function create($sql, $params = null, $types = null) {
        $this->query($sql, $params, $types);
    }

    public function insert($sql, $params = null, $types = null) {
        $this->query($sql, $params, $types);
    }

    public function update($sql, $params = null, $types = null) {
        $this->query($sql, $params, $types);
    }

    public function delete($sql, $params = null, $types = null) {
        $this->query($sql, $params, $types);
    }

    public function fetch($sql, $params = null, $types = null) {
        return $this->query($sql, $params, $types);
    }
}