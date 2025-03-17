<?php

require_once('app/config/database.php');
require_once('app/models/StudentModel.php');
require_once('app/models/NganhHocModel.php');

class StudentController
{
    private $studentModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->studentModel = new StudentModel($this->db);
    }

    //function list product
    public function index()
    {
        $students = $this->studentModel->getStudents();
        include 'app/views/student/list.php';
    }
    public function list()
    {
        $this->index(); // Gọi luôn index() để tránh lặp code
    }

    //function show student
    public function show($MaSV)
    {
        $student = $this->studentModel->getStudentById($MaSV);

        if ($student) {
            include 'app/views/student/show.php';
        } else {
            echo 'Khong tim thay sinh vien';
        }
    }

    public function add()
    {
        $nganhHoc = (new NganhHocModel($this->db))->getAllNganhHoc();
        include_once 'app/views/student/add.php';
    }


    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $NgaySinh = $_POST['NgaySinh'] ?? '';
            $MaSV = $_POST['MaSV'] ?? null;
            $MaNganh = $_POST['MaNganh'] ?? null;
            $Hinh = null;

            if (!empty($_FILES['Hinh']['name'])) {
                $uploadDir = 'uploads/' . date('Y/m/d') . '/'; // Tạo thư mục theo ngày (VD: uploads/2025/03/11/)
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
                }

                $imagePath = $uploadDir . basename($_FILES["Hinh"]["name"]);
                move_uploaded_file($_FILES["Hinh"]["tmp_name"], $imagePath);

                $Hinh = $imagePath; // Lưu đường dẫn này vào database
            }

            $result = $this->studentModel->addStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $MaNganh, $Hinh);

            if (is_array($result)) {
                $errors = $result;
                $nganhHoc = (new NganhHocModel($this->db))->getAllNganhHoc();
                include 'app/views/student/add.php';
            } else {
                header('Location: /KT/KiemTra/Student');
            }
        }
    }


    public function edit($id)
    {
        $student = $this->studentModel->getStudentById($id);
        $nganhHoc = (new NganhHocModel($this->db))->getAllNganhHoc();

        if ($student) {
            include 'app/views/student/edit.php';
        } else {
            echo ' Khong tim thay sinh vien';
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $MaNganh = $_POST['MaNganh'];
            $Hinh = null;

            // Kiểm tra nếu có hình ảnh mới
            if (!empty($_FILES['Hinh']['HoTen'])) {
                $uploadDir = 'uploads/' . date('Y/m/d') . '/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imagePath = $uploadDir . basename($_FILES["Hinh"]["HoTen"]);
                move_uploaded_file($_FILES["Hinh"]["tmp_name"], $imagePath);
                $Hinh = $imagePath;
            }

            // Cập nhật sản phẩm với ảnh hoặc giữ nguyên ảnh cũ
            $edit = $this->studentModel->updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $MaNganh, $Hinh);

            if ($edit) {
                header('Location: /KT/KiemTra/Student');
            } else {
                echo 'Đã có lỗi xảy ra khi luu sinh vien';
            }
        }
    }



    public function delete($id)
    {
        if ($this->studentModel->deleteStudent($id)) {
            header('Location: /KT/KiemTra/Student');
        } else {
            echo 'Da xay ra loi khi xoa sinh vien';
        }
    }
}
