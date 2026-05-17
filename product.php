<?php
require_once "app/model/Database.php";
require_once "app/model/Product.php";

$productModel = new Product();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Không tìm thấy sản phẩm");
}

// lấy 1 sản phẩm
$product = $productModel->getById($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

    <title>Home</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="public/images/Title">QuanLySach</a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-3">

                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="list.php">List</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="public/images/<?php echo $product['hinh_anh'] ?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h2><?php echo $product['ten_sach']; ?></h2>

                <p><?php echo $product['ten_tac_gia']; ?></p>

                <p><?php echo $product['mo_ta']; ?></p>

                <p>Giá: <?php echo $product['gia']; ?></p>

                <p>Năm: <?php echo $product['nam_xuat_ban']; ?></p>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>