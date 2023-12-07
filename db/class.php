<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class admin_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function login($username, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
}
