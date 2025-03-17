<?php include 'app/views/shares/header.php'; ?>

<h1>Thêm Ngành Học</h1>
<form method="POST" action="/KT/KiemTra/NganhHoc/save">
    <div class="form-group">
        <label for="MaNganh">Mã Ngành:</label>
        <input type="text" id="MaNganh" name="MaNganh" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="TenNganh">Tên Ngành:</label>
        <input type="text" id="TenNganh" name="TenNganh" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="/KT/KiemTra/NganhHoc" class="btn btn-secondary mt-2">Quay lại</a>
</form>

<?php include 'app/views/shares/footer.php'; ?>