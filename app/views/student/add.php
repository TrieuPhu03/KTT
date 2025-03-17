<?php include 'app/views/shares/header.php'; ?>

<h1>Thêm Sinh Viên Mới</h1>

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
    <div class="form-group">
        <label for="MaSV">Mã Sinh Viên:</label>
        <input type="text" id="MaSV" name="MaSV" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Giới Tính:</label>
        <div>
            <label><input type="radio" name="GioiTinh" value="M" required> Nam</label>
            <label><input type="radio" name="GioiTinh" value="F"> Nữ</label>
        </div>
    </div>

    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="MaNganh">Ngành Học:</label>
        <select id="MaNganh" name="MaNganh" class="form-control" required>
            <?php foreach ($nganhHoc as $ng1): ?>
                <option value="<?php echo $ng1->MaNganh; ?>">
                    <?php echo htmlspecialchars($ng1->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="Hinh">Chọn ảnh sinh viên:</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
    <a href="/KT/KiemTra/Student/list" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>

<?php include 'app/views/shares/footer.php'; ?>