<?php
require_once('app/config/database.php');
require_once('app/models/NganhHocModel.php');

class NganhHocController
{
    private $nganhHocModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->nganhHocModel = new NganhHocModel($db);
    }

    // Hiển thị danh sách ngành học
    public function index()
    {
        $nganhHocs = $this->nganhHocModel->getAllNganhHoc();
        include 'app/views/nganhhoc/list.php';
    }

    // Hiển thị form thêm ngành học
    public function add()
    {
        include 'app/views/nganhhoc/add.php';
    }

    // Lưu ngành học mới
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaNganh = $_POST['MaNganh'] ?? '';
            $TenNganh = $_POST['TenNganh'] ?? '';

            if (empty($MaNganh) || empty($TenNganh)) {
                $errors = "Mã ngành và Tên ngành không được để trống.";
                include 'app/views/nganhhoc/add.php';
                return;
            }

            if ($this->nganhHocModel->getNganhHocById($MaNganh)) {
                $errors = "Mã ngành đã tồn tại.";
                include 'app/views/nganhhoc/add.php';
                return;
            }

            $result = $this->nganhHocModel->addNganhHoc($MaNganh, $TenNganh);

            if ($result) {
                header('Location: /KT/KiemTra/NganhHoc');
            } else {
                echo "Có lỗi xảy ra khi thêm ngành học.";
            }
        }
    }

    // Hiển thị form sửa ngành học
    public function edit($MaNganh)
    {
        $nganhHoc = $this->nganhHocModel->getNganhHocById($MaNganh);
        if ($nganhHoc) {
            include 'app/views/nganhhoc/edit.php';
        } else {
            echo "Không tìm thấy ngành học.";
        }
    }

    // Cập nhật ngành học
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaNganh = $_POST['MaNganh'] ?? '';
            $TenNganh = $_POST['TenNganh'] ?? '';

            if (empty($MaNganh) || empty($TenNganh)) {
                echo "Mã ngành và Tên ngành không được để trống.";
                return;
            }

            $result = $this->nganhHocModel->updateNganhHoc($MaNganh, $TenNganh);

            if ($result) {
                header('Location: /KT/KiemTra/NganhHoc');
            } else {
                echo "Có lỗi xảy ra khi cập nhật ngành học.";
            }
        }
    }

    // Xóa ngành học
    public function delete($MaNganh)
    {
        $result = $this->nganhHocModel->deleteNganhHoc($MaNganh);

        if ($result) {
            header('Location: /KT/KiemTra/NganhHoc');
        } else {
            echo "Có lỗi xảy ra khi xóa ngành học.";
        }
    }
}
