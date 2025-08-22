<?php
require_once __DIR__ . '/../Core/DB.php';
class UserModel{
    public function findByUsername($username){
         $rows = querySql("SELECT * FROM users WHERE username = ?", [$username]);
        return $rows[0] ?? null;
    }
    public function verifyPassword($username, $password): bool {
        $user = $this->findByUsername($username);
        if (!$user) return false;
        return $password === $user['password'];
    }
}