<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xóa sinh viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="header">
            <h2 class="mb-4">Xóa sinh viên:  
                <?php if (isset($student['ma_sv'])): ?>
                    <?= htmlspecialchars($student['ho_ten'])?>
                <?php else: ?>
                    <span class="text-danger">[Sinh viên không tồn tại]</span>
                <?php endif; ?>
            </h2>
        </div>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="index.php?action=destroy" method="POST">
            <input type="hidden" name="original_ma_sv" value="<?= htmlspecialchars($originalMaSv ?? ($student['ma_sv'] ?? '')) ?>">
            <div class="form-group">
                <label for="ma_sv">Mã SV</label>
                <input type="text" class="form-control" id="ma_sv" name="ma_sv" placeholder="1071051836" 
                required value="<?= isset($student['ma_sv']) ? htmlspecialchars($student['ma_sv']) : '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="ho_ten">Họ và tên</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nguyễn Thị Hoa" 
                required value="<?= isset($student['ho_ten']) ? htmlspecialchars($student['ho_ten']) : '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới tính</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioi_tinh" id="gioi_tinh_nam" value="Nam" disabled
                    <?= (isset($student['gioi_tinh']) && $student['gioi_tinh'] === 'Nam') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gioi_tinh_nam">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioi_tinh" id="gioi_tinh_nu" value="Nữ" disabled
                    <?= (isset($student['gioi_tinh']) && $student['gioi_tinh'] === 'Nữ') ? 'checked' : '' ?> readonly>
                    <label class="form-check-label" for="gioi_tinh_nu">Nữ</label>
                </div>
            </div>
            <div class="form-group">
                <label for="khoa_id">Khoa</label>
                <select class="form-control" id="khoa_id" name="khoa_id" disabled>
                    <option value="">--Chọn khoa--</option>
                    <?php foreach ($faculties as $faculty): ?>
                        <option value="<?= htmlspecialchars($faculty['id']) ?>" 
                        <?= (isset($student['khoa_id']) && (string)$student['khoa_id'] === (string)$faculty['id']) ? 'selected' : '' ?> aria-readonly="true">
                            <?= htmlspecialchars($faculty['ten_khoa']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>