<?php
session_start();
require_once "app/model/Database.php";
require_once "app/model/Product.php";

$productModel = new Product();

$message = "";

// xử lý form
if (isset($_POST['submit'])) {

    $ten_sach = $_POST['ten_sach'];
    $ma_isbn = $_POST['ma_isbn'];
    $nam_xuat_ban = $_POST['nam_xuat_ban'];
    $gia = $_POST['gia'];
    $so_luong = $_POST['so_luong'];

    // upload ảnh
    $hinh_anh = $_FILES['hinh_anh']['name'];
    $tmp = $_FILES['hinh_anh']['tmp_name'];

    move_uploaded_file($tmp, "public/images/" . $hinh_anh);

    $the_loai_id = $_POST['the_loai_id'];
    $tac_gia_id = $_POST['tac_gia_id'];
    $nha_xuat_ban_id = $_POST['nha_xuat_ban_id'];
    $mo_ta = $_POST['mo_ta'];

    $result = $productModel->insert(
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

    if ($result) {
        $message = "Thêm sách thành công!";
    } else {
        $message = "Thêm sách thất bại!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Thêm Sách</h2>

    <?php if ($message) { ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <input class="form-control mb-2" type="text" name="ten_sach" placeholder="Tên sách">

        <input class="form-control mb-2" type="text" name="ma_isbn" placeholder="Mã ISBN">

        <input class="form-control mb-2" type="number" name="nam_xuat_ban" placeholder="Năm xuất bản">

        <input class="form-control mb-2" type="number" name="gia" placeholder="Giá">

        <input class="form-control mb-2" type="number" name="so_luong" placeholder="Số lượng">

        <input class="form-control mb-2" type="file" name="hinh_anh">

        <input class="form-control mb-2" type="number" name="the_loai_id" placeholder="Thể loại ID">

        <input class="form-control mb-2" type="number" name="tac_gia_id" placeholder="Tác giả ID">

        <input class="form-control mb-2" type="number" name="nha_xuat_ban_id" placeholder="Nhà xuất bản ID">

        <textarea class="form-control mb-2" name="mo_ta" placeholder="Mô tả"></textarea>

        <button class="btn btn-primary" type="submit" name="submit">
            Thêm sách
        </button>

    </form>

</div>

</body>
</html>