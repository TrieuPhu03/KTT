<?php include 'app/views/shares/header.php'; ?>

<div class="container">
    <h1 class="mt-4">Danh sách Ngành Học</h1>
    <a href="/KT/KiemTra/NganhHoc/add" class="btn btn-success mb-3">Thêm Ngành Học</a>

    <?php if (!empty($nganhHocs)): ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Mã Ngành</th>
                    <th>Tên Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nganhHocs as $index => $nganhHoc): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($nganhHoc->MaNganh, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($nganhHoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="/KT/KiemTra/NganhHoc/edit/<?php echo $nganhHoc->MaNganh; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/KT/KiemTra/NganhHoc/delete/<?php echo $nganhHoc->MaNganh; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa ngành học này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">Không có ngành học nào.</div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>