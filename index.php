<?php
require_once __DIR__ . '/app/Controllers/StudentController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

$authController = new AuthController();
$studentController = new StudentController();

function checkAuth() {
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }
}

$action = $_GET['action'] ?? 'index';

$publicActions = ['login', 'authenticate'];

if (!in_array($action, $publicActions)) {
    checkAuth();
}

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'authenticate':
        $authController->authenticate();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'create':
        $studentController->create();
        break;
    case 'edit':
        $studentController->edit();
        break;
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentController->update($_POST);
        }
        break;
    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentController->store($_POST);
        }
        break;
    case 'delete':
        if (isset($_GET['ma_sv'])) {
            $studentController->delete($_GET['ma_sv']);
        }
        break;
    case 'destroy':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentController->destroy($_POST);
        }
        break;
    default:
        $studentController->index();
        break;
}
