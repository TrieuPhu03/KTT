<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách Sinh Viên</h1>

<a href="/KT/KiemTra/Student/add" class="btn btn-success mb-2">Thêm Sinh Viên Mới</a>

<ul class="list-group">
    <?php foreach ($students as $student): ?>
        <li class="list-group-item d-flex align-items-center">
            <!-- Hiển thị ảnh sinh viên -->
            <?php if (!empty($student->Hinh)): ?>
                <img src="<?php echo str_replace('\\', '/', $student->Hinh); ?>" alt="Ảnh sinh viên" width="100">
            <?php else: ?>
                <img src="/uploads/default.png" alt="Ảnh mặc định" class="img-thumbnail" width="100">
            <?php endif; ?>

            <div class="ms-3">
                <h2>
                    <a href="/KT/KiemTra/Student/show/<?php echo $student->MaSV; ?>">
                        <?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </h2>
                <p><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Giới Tính:</strong> <?php echo ($student->GioiTinh == 'M') ? 'Nam' : 'Nữ'; ?></p>
                <p><strong>Ngày Sinh:</strong> <?php echo date("d/m/Y", strtotime($student->NgaySinh)); ?></p>
                <p><strong>Ngành Học:</strong> <?php echo htmlspecialchars($student->TenNganh, ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="/KT/KiemTra/Student/show/<?php echo $student->MaSV; ?>" class="btn btn-warning">Chi Tiet</a>

                <a href="/KT/KiemTra/Student/edit/<?php echo $student->MaSV; ?>" class="btn btn-warning">Sửa</a>
                <a href="/KT/KiemTra/Student/delete/<?php echo $student->MaSV; ?>"
                    class="btn btn-danger"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'app/views/shares/footer.php'; ?>