<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check if a user exists
    public function checkUserExists($username) {
        $stmt = $this->conn->prepare("SELECT id FROM Users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Create a new user
    public function createUser($username, $password, $email, $role) {
        $stmt = $this->conn->prepare("INSERT INTO Users (username, password, email, role) VALUES (:username, :password, :email, :role)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);
        return $stmt->execute();
    }

    // Retrieve user by username
    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
