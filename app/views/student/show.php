<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Chi Tiết Sinh Viên</h1>

    <?php if ($student): ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <!-- Hiển thị ảnh sinh viên -->
                        <?php if (!empty($student->Hinh)): ?>
                            <img src="/KT/KiemTra/<?php echo $student->Hinh; ?>" alt="Ảnh sinh viên" class="img-fluid rounded mb-3" style="max-width: 200px;">
                        <?php else: ?>
                            <img src="/uploads/default.png" alt="Ảnh mặc định" class="img-fluid rounded mb-3" style="max-width: 200px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <h2 class="card-title mb-4"><?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="card-text"><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text"><strong>Giới Tính:</strong> <?php echo ($student->GioiTinh == 'M') ? 'Nam' : 'Nữ'; ?></p>
                        <p class="card-text"><strong>Ngày Sinh:</strong> <?php echo date("d/m/Y", strtotime($student->NgaySinh)); ?></p>
                        <p class="card-text"><strong>Ngành Học:</strong> <?php echo htmlspecialchars($student->TenNganh, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="/KT/KiemTra/Student/edit/<?php echo $student->MaSV; ?>" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Sửa
                    </a>
                    <a href="/KT/KiemTra/Student/delete/<?php echo $student->MaSV; ?>" class="btn btn-danger me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                        <i class="bi bi-trash"></i> Xóa
                    </a>
                    <a href="/KT/KiemTra/Student" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger text-center">Không tìm thấy sinh viên.</p>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>