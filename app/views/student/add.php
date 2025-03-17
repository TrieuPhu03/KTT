<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm Sinh Viên Mới</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/KT/KiemTra/Student/save" onsubmit="return validateForm();" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="MaSV" class="form-label">Mã Sinh Viên:</label>
            <input type="text" id="MaSV" name="MaSV" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ Tên:</label>
            <input type="text" id="HoTen" name="HoTen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <div class="form-check form-check-inline">
                <input type="radio" name="GioiTinh" value="Nam" class="form-check-input" required>
                <label class="form-check-label">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="GioiTinh" value="Nu" class="form-check-input">
                <label class="form-check-label">Nữ</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
            <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="MaNganh" class="form-label">Ngành Học:</label>
            <select id="MaNganh" name="MaNganh" class="form-select" required>
                <?php foreach ($nganhHoc as $ng1): ?>
                    <option value="<?php echo $ng1->MaNganh; ?>">
                        <?php echo htmlspecialchars($ng1->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="Hinh" class="form-label">Chọn ảnh sinh viên:</label>
            <input type="file" id="Hinh" name="Hinh" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
            <a href="/KT/KiemTra/Student/list" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>