<?php
class NganhHocModel
{
    private $conn;
    private $table_name = 'nganhhoc';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả ngành học
    public function getAllNganhHoc()
    {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy ngành học theo mã
    public function getNganhHocById($MaNganh)
    {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name . " WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Thêm ngành học mới
    public function addNganhHoc($MaNganh, $TenNganh)
    {
        $query = "INSERT INTO " . $this->table_name . " (MaNganh, TenNganh) VALUES (:MaNganh, :TenNganh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);
        $stmt->bindParam(':TenNganh', $TenNganh, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Cập nhật thông tin ngành học
    public function updateNganhHoc($MaNganh, $TenNganh)
    {
        $query = "UPDATE " . $this->table_name . " SET TenNganh = :TenNganh WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);
        $stmt->bindParam(':TenNganh', $TenNganh, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xóa ngành học
    public function deleteNganhHoc($MaNganh)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
