<?php
require_once __DIR__ . '/../Core/DB.php';
class FacultyModel
{
    public function all(): array
    {
        return querySql('SELECT * FROM faculties');
    }
    public function create($data): int
    {
        $sql = "INSERT INTO faculties (ma_khoa, ten_khoa) VALUES (?,?)";
        return excSql($sql, [$data['ma_khoa'], $data['ten_khoa']]);
    }
    public function find($id): array
    {
        $rows = querySql("SELECT * FROM faculties WHERE id = ?", [$id]);
        return $rows[0] ?? null;
    }
    public function update($id, $data): int
    {
        $qsl = "UPDATE faculties SET ma_khoa=? ten_khoa=? WHERE id=?";
        return excSql($qsl, [$data['ma_khoa'], $data['ten_khoa'], $id]);
    }
    public function delete($id): int
    {
        $sql = "DELETE FROM faculties WHERE id=?";
        return excSql($sql, [$id]);
    }
}