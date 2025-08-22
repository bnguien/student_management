<?php
require_once __DIR__ . '/app/Controllers/StudentController.php';

$controller = new StudentController();

// Lấy URL từ query
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update($_POST);
        }
        break;
    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store($_POST);
        }
        break;
    case 'delete':
        if (isset($_GET['ma_sv'])) {
            $controller->delete($_GET['ma_sv']);
        }
        break;
    case 'destroy':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->destroy($_POST);
        }
        break;
    default:
        $controller->index();
        break;
}
