<?php
class StudentModel
{
    private $conn;
    private $table_name = 'sinhvien';

    public function __construct($db)
    {
        $this->conn =  $db;
    }


    //function get all product
    public function getStudents()
    {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh 
        FROM " . $this->table_name . " sv 
        LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    //function get product by id
    public function getStudentById($id)
    {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, sv.MaNganh, nh.TenNganh 
          FROM " . $this->table_name . " sv 
          LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
          WHERE sv.MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function validateNgaySinh($NgaySinh)
    {
        $date = DateTime::createFromFormat('Y-m-d', $NgaySinh);
        return $date && $date->format('Y-m-d') === $NgaySinh;
    }

    //function add product
    public function addStudent($HoTen, $GioiTinh, $NgaySinh, $MaNganh, $Hinh)
    {
        $errors = [];

        // Kiểm tra MaNganh có tồn tại trong bảng nganhhoc không
        $checkQuery = "SELECT COUNT(*) FROM nganhhoc WHERE MaNganh = :MaNganh";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':MaNganh', $MaNganh);
        $checkStmt->execute();
        $exists = $checkStmt->fetchColumn();

        if ($exists == 0) {
            $errors['MaNganh'] = 'Ngành học không tồn tại';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, MaNganh, Hinh) VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :MaNganh, :Hinh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':MaNganh', $MaNganh);
        $stmt->bindParam(':Hinh', $Hinh);

        return $stmt->execute();
    }

    //function update producr

    public function updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $MaNganh, $Hinh = null)
    {
        // Nếu không có ảnh mới, lấy ảnh cũ
        if (!$Hinh) {
            $query = "SELECT Hinh FROM " . $this->table_name . " WHERE MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaSV', $MaSV, PDO::PARAM_STR);
            $stmt->execute();
            $oldImage = $stmt->fetch(PDO::FETCH_OBJ);

            if ($oldImage) {
                $Hinh = $oldImage->Hinh;
            }
        }

        // Cập nhật thông tin sinh viên
        $query = "UPDATE " . $this->table_name . " 
              SET HoTen=:HoTen, GioiTinh=:GioiTinh, NgaySinh=:NgaySinh, MaNganh=:MaNganh, Hinh=:Hinh 
              WHERE MaSV=:MaSV";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $HoTen = htmlspecialchars(strip_tags($HoTen));
        $GioiTinh = htmlspecialchars(strip_tags($GioiTinh));
        $MaNganh = htmlspecialchars(strip_tags($MaNganh));
        $MaSV = htmlspecialchars(strip_tags($MaSV));

        // Kiểm tra và định dạng lại ngày sinh nếu cần
        if (!$this->validateNgaySinh($NgaySinh)) {
            return ['NgaySinh' => 'Ngày sinh không hợp lệ'];
        } else {
            // Nếu đang ở định dạng Y-m-d thì giữ nguyên, nếu không thì chuyển đổi từ d/m/Y
            $dateObj = DateTime::createFromFormat('Y-m-d', $NgaySinh);

            if (!$dateObj) {
                return ['NgaySinh' => 'Ngày sinh không hợp lệ'];
            }

            // Giữ nguyên định dạng Y-m-d cho database
            $NgaySinh = $dateObj->format('Y-m-d');
        }

        // Gán giá trị vào câu lệnh SQL
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':MaNganh', $MaNganh);
        $stmt->bindParam(':Hinh', $Hinh);
        $stmt->bindParam(':MaSV', $MaSV);

        // Thực thi cập nhật
        return $stmt->execute();
    }
    //function delete product
    public function deleteStudent($MaSV)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $MaSV, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
