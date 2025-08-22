<?php
require_once __DIR__ . '/../Core/DB.php';
class StudentModel
{
    public function all(): array
    {
        return querySql("SELECT s.*, f.ten_khoa
        FROM students s
        JOIN faculties f ON s.khoa_id = f.id");
    }
    public function getByFacultyId($id){
        $sql = "SELECT s.*, f.ten_khoa
                FROM students s
                JOIN faculties f ON s.khoa_id = f.id
                WHERE s.khoa_id = ?";
        return querySql($sql, [$id]);
    }
    public function find($ma_sv): ?array
    {
        $rows = querySql("SELECT * FROM students WHERE ma_sv = ?", [$ma_sv]);
        return $rows[0] ?? null;
    }
    public function create(array $data): int
    {
        $sql = "INSERT INTO students (ma_sv, ho_ten, gioi_tinh, khoa_id)
            VALUES (?,?,?,?)";
        return excSql($sql, [
            $data['ma_sv'],
            $data['ho_ten'],
            $data['gioi_tinh'],
            $data['khoa_id']
        ]);
    }
    public function update(string $originalMaSv, array $data): int
    {
        $sql = "UPDATE students SET ma_sv = ?, ho_ten = ?, gioi_tinh = ?, khoa_id = ? WHERE ma_sv = ?";
        return excSql($sql, [
            $data['ma_sv'],
            $data['ho_ten'],
            $data['gioi_tinh'],
            $data['khoa_id'],
            $originalMaSv
        ]);
    }
    public function delete($ma_sv): int
    {
        $sql = "DELETE FROM students WHERE ma_sv = ?";
        return excSql($sql, [$ma_sv]);
    }
}
