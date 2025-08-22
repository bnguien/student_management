<?php
require_once __DIR__ . '/../Config/config.php';
function pdo(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
    return $pdo;
}
function querySql($sql, $params = []): array
{
    $stmt = pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function excSql($sql, $params = []): int
{
    $stmt = pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}