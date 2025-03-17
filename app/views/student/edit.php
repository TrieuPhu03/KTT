<?php include 'app/views/shares/header.php'; ?>

<h1>Sửa Thông Tin Sinh Viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/KT/KiemTra/Student/update" enctype="multipart/form-data" onsubmit="return validateForm();">
    <input type="hidden" name="MaSV" value="<?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?>">

    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" class="form-control"
            value="<?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label>Giới Tính:</label>
        <div>
            <label><input type="radio" name="GioiTinh" value="M" <?php echo ($student->GioiTinh == 'M') ? 'checked' : ''; ?> required> Nam</label>
            <label><input type="radio" name="GioiTinh" value="F" <?php echo ($student->GioiTinh == 'F') ? 'checked' : ''; ?>> Nữ</label>
        </div>
    </div>

    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" class="form-control"
            value="<?php echo htmlspecialchars($student->NgaySinh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="MaNganh">Ngành Học:</label>
        <select id="MaNganh" name="MaNganh" class="form-control" required>
            <?php foreach ($nganhHoc as $nganhhoc): ?>
                <option value="<?php echo $nganhhoc->MaNganh; ?>"
                    <?php echo ($nganhhoc->MaNganh == $student->MaNganh) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($nganhhoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Hiển thị ảnh hiện tại -->
    <div class="form-group">
        <label>Ảnh Hiện Tại:</label>
        <?php if (!empty($student->Hinh)): ?>
            <div>
                <img src="<?php echo str_replace('\\', '/', $student->Hinh); ?>" alt="Ảnh sinh viên" width="100">
            </div>
        <?php else: ?>
            <p>Không có ảnh</p>
        <?php endif; ?>
    </div>

    <!-- Chọn ảnh mới -->
    <div class="form-group">
        <label for="Hinh">Chọn Ảnh Mới:</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
    <a href="/KT/KiemTra/Student/list" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>

<?php include 'app/views/shares/footer.php'; ?>