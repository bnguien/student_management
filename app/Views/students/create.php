<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm mới sinh viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="header">
            <h1 class="mb-4">Thêm mới sinh viên</h1>
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
        <form action="index.php?action=store" method="POST">
            <div class="form-group">
                <label for="ma_sv">Mã SV</label>
                <input type="text" class="form-control" id="ma_sv" name="ma_sv" placeholder="1071051836" required value="<?= isset($old['ma_sv']) ? htmlspecialchars($old['ma_sv']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="ho_ten">Họ và tên</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nguyễn Thị Hoa" required value="<?= isset($old['ho_ten']) ? htmlspecialchars($old['ho_ten']) : '' ?>">
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới tính</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioi_tinh" id="gioi_tinh_nam" value="Nam" <?= (isset($old['gioi_tinh']) ? $old['gioi_tinh'] === 'Nam' : true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gioi_tinh_nam">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioi_tinh" id="gioi_tinh_nu" value="Nữ" <?= (isset($old['gioi_tinh']) && $old['gioi_tinh'] === 'Nữ') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gioi_tinh_nu">Nữ</label>
                </div>
            </div>

            <div class="form-group">
                <label for="Khoa">Khoa</label>
                <select class="form-control" id="khoa_id" name="khoa_id">
                    <option value="">--Chọn khoa--</option>
                    <?php foreach ($faculties as $faculty): ?>
                        <option value="<?= htmlspecialchars($faculty['id']) ?>" <?= (isset($old['khoa_id']) && (string)$old['khoa_id'] === (string)$faculty['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($faculty['ten_khoa']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>