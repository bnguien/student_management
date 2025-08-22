<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <!-- Bộ lọc -->
        <div class="d-flex">
            <form class="d-flex" method="GET" action="index.php">
                <input type="hidden" name="action" value="index">
                <select class="form-control mr-2" id="khoa_id" name="khoa_id">
                    <option value="">--Chọn khoa--</option>
                    <?php 
                        $selectedKhoaId = isset($_GET['khoa_id']) ? (string)$_GET['khoa_id'] : '';
                        foreach ($faculties as $faculty): 
                    ?>
                        <option value="<?= htmlspecialchars($faculty['id']) ?>" <?= ($selectedKhoaId !== '' && $selectedKhoaId === (string)$faculty['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($faculty['ten_khoa']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary ml-auto">Xem</button>
            </form>
            <a href="index.php?action=create" class="btn btn-success ml-auto">Thêm mới</a>
        </div>
        <!-- Bảng danh sách sinh viên -->
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>MSSV</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Khoa</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['ma_sv']) ?></td>
                            <td><?= htmlspecialchars($student['ho_ten']) ?></td>
                            <td><?= htmlspecialchars($student['gioi_tinh']) ?></td>
                            <td>
                                <?= htmlspecialchars($student['ten_khoa']) ?>
                            </td>
                            <td>
                                <a href="index.php?action=edit&ma_sv=<?= urlencode($student['ma_sv']) ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="index.php?action=delete&ma_sv=<?= $student['ma_sv'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có dữ liệu sinh viên</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>