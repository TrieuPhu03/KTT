<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Chi Tiết Sinh Viên</h1>

    <?php if ($student): ?>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?></h2>

                <!-- Hiển thị ảnh sinh viên -->
                <?php if (!empty($student->Hinh)): ?>
                    <img src="<?php echo '/uploads/2025/03/17/sv1.jpg'; ?>" alt="Ảnh sinh viên" width="100">
                <?php else: ?>
                    <img src="/uploads/default.png" alt="Ảnh mặc định" class="img-thumbnail mb-3" width="150">
                <?php endif; ?>

                <p class="card-text"><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Giới Tính:</strong> <?php echo ($student->GioiTinh == 'M') ? 'Nam' : 'Nữ'; ?></p>
                <p class="card-text"><strong>Ngày Sinh:</strong> <?php echo date("d/m/Y", strtotime($student->NgaySinh)); ?></p>
                <p class="card-text"><strong>Ngành Học:</strong> <?php echo htmlspecialchars($student->TenNganh, ENT_QUOTES, 'UTF-8'); ?></p>

                <a href="/KT/KiemTra/Student/edit/<?php echo $student->MaSV; ?>" class="btn btn-warning">Sửa</a>
                <a href="/KT/KiemTra/Student/delete/<?php echo $student->MaSV; ?>" class="btn btn-danger"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
                <a href="/KT/KiemTra/Student" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger">Không tìm thấy sinh viên.</p>
    <?php endif; ?>

</div>

<?php include 'app/views/shares/footer.php'; ?>