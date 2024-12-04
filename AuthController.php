<?php
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Register a new user
    public function register($username, $password, $email, $role) {
        $user = new User($this->db);

        if ($user->checkUserExists($username)) {
            return "Username already exists.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $user->createUser($username, $hashedPassword, $email, $role);

        return $result ? "Registration successful." : "Error during registration.";
    }

    // Login an existing user
    public function login($username, $password) {
        $user = new User($this->db);
        $userData = $user->getUserByUsername($username);

        if ($userData && password_verify($password, $userData['password'])) {
            session_start();
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['role'];
            return "Login successful.";
        }

        return "Invalid username or password.";
    }

    // Logout user
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return "Logged out successfully.";
    }
}
?>
