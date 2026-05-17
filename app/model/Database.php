<?php

class Database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "quanlysach");

        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }
}