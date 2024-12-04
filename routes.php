<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';

$authController = new AuthController();
$dashboardController = new DashboardController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'register':
            echo $authController->register($_POST['username'], $_POST['password'], $_POST['email'], $_POST['role']);
            break;
        
        case 'login':
            echo $authController->login($_POST['username'], $_POST['password']);
            break;
        
        case 'logout':
            echo $authController->logout();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['dashboard']) && isset($_SESSION['user_id'])) {
        $role = $_SESSION['role'];
        if ($role === 'student') {
            echo json_encode($dashboardController->loadStudentDashboard($_SESSION['user_id']));
        } elseif ($role === 'employee') {
            echo json_encode($dashboardController->loadEmployeeDashboard($_SESSION['user_id']));
        }
    }
}
?>
