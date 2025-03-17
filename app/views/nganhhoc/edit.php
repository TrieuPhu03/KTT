<?php include 'app/views/shares/header.php'; ?>

<h1>Sửa Ngành Học</h1>
<form method="POST" action="/KT/KiemTra/NganhHoc/update">
    <input type="hidden" name="MaNganh" value="<?php echo htmlspecialchars($nganhHoc->MaNganh, ENT_QUOTES, 'UTF-8'); ?>">

    <div class="form-group">
        <label for="TenNganh">Tên Ngành:</label>
        <input type="text" id="TenNganh" name="TenNganh" class="form-control"
            value="<?php echo htmlspecialchars($nganhHoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    <a href="/KT/KiemTra/NganhHoc" class="btn btn-secondary mt-2">Quay lại</a>
</form>

<?php include 'app/views/shares/footer.php'; ?>