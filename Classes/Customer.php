<?php
require_once "Connect.php";

class User extends Database {


    public function addUser($username, $gmail, $phone_num, $address, $password, $first_name, $last_name) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, gmail, phone_num, address, password, first_name, last_name, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssss', $username, $gmail, $phone_num, $address, $hashed_password, $first_name, $last_name);
        $stmt->execute();
    }
    public function editUser($id, $username, $gmail, $phone_num, $address, $password, $first_name, $last_name) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username=?, gmail=?, phone_num=?, address=?, password=?, first_name=?, last_name=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssssi', $username, $gmail, $phone_num, $address, $hashed_password, $first_name, $last_name, $id);
        $stmt->execute();
    }
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}
?>