<?php
require_once __DIR__ . '/../Models/UserModel.php';

class AuthController{
    private $userModel;
    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login(){
        require_once __DIR__ .'/../Views/auth/login.php';
    }

    public function authenticate(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username) || empty($password)){
             $errors[] = 'Vui lòng nhập đầy đủ thông tin';
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }
        if ($this->userModel->verifyPassword($username, $password)) {
            session_start();
            $_SESSION['user_id'] = $username;
            $_SESSION['logged_in'] = true;
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Tên đăng nhập hoặc mật khẩu không đúng';
            require __DIR__ . '/../Views/auth/login.php';
        }
    }
     public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}