<?php
require_once __DIR__ . "/Database.php";

class Product extends Database
{
    // Lấy tất cả sản phẩm
    public function getAll()
    {
        $sql = "SELECT sach.*, tac_gia.ten_tac_gia 
            FROM sach
            JOIN tac_gia ON sach.tac_gia_id = tac_gia.id";
        $result = $this->conn->query($sql);

        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Thêm sách
    public function insert(
        $ten_sach,
        $ma_isbn,
        $nam_xuat_ban,
        $gia,
        $so_luong,
        $hinh_anh,
        $the_loai_id,
        $tac_gia_id,
        $nha_xuat_ban_id,
        $mo_ta
    ) {

        $sql = "INSERT INTO sach(
                    ten_sach,
                    ma_isbn,
                    nam_xuat_ban,
                    gia,
                    so_luong,
                    hinh_anh,
                    the_loai_id,
                    tac_gia_id,
                    nha_xuat_ban_id,
                    mo_ta,
                    created_at
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssdsdiii",
            $ten_sach,
            $ma_isbn,
            $nam_xuat_ban,
            $gia,
            $so_luong,
            $hinh_anh,
            $the_loai_id,
            $tac_gia_id,
            $nha_xuat_ban_id,
            $mo_ta
        );

        return $stmt->execute();
    }

    // Cập nhật sách
    public function update(
        $id,
        $ten_sach,
        $ma_isbn,
        $nam_xuat_ban,
        $gia,
        $so_luong,
        $hinh_anh,
        $the_loai_id,
        $tac_gia_id,
        $nha_xuat_ban_id,
        $mo_ta
    ) {

        $sql = "UPDATE sach SET
                    ten_sach = ?,
                    ma_isbn = ?,
                    nam_xuat_ban = ?,
                    gia = ?,
                    so_luong = ?,
                    hinh_anh = ?,
                    the_loai_id = ?,
                    tac_gia_id = ?,
                    nha_xuat_ban_id = ?
                    mo_ta = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssdsdiiiis",
            $ten_sach,
            $ma_isbn,
            $nam_xuat_ban,
            $gia,
            $so_luong,
            $hinh_anh,
            $the_loai_id,
            $tac_gia_id,
            $nha_xuat_ban_id,
            $id,
            $mo_ta
        );

        return $stmt->execute();
    }

    // Xóa sách
    public function delete($id)
    {
        $sql = "DELETE FROM sach WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
    //tim theo tac gia
    public function getById($id)
    {
        $sql = "SELECT sach.*, tac_gia.ten_tac_gia
            FROM sach
            JOIN tac_gia ON sach.tac_gia_id = tac_gia.id
            WHERE sach.id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
