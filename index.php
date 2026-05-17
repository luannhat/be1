<?php
session_start();


require_once "app/model/Database.php";
require_once "app/model/Product.php";

$productModel = new Product();
$products = $productModel->getAll();
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
                    <?php if (isset($_SESSION['user'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>

                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">

            <?php foreach ($products as $product) { ?>

                <div class="book-card">

                    <div class="book-img">
                        <img src="public/images/<?php echo $product['hinh_anh']; ?>">
                    </div>

                    <div class="book-info">
                        <h4>
                            <a href="product.php?id=<?php echo $product['id']; ?>">
                                <?php echo $product['ten_sach']; ?>
                            </a>
                        </h4>
                        <p><?php echo $product['ten_tac_gia']; ?></p>
                        <p><?php echo $product['nam_xuat_ban']; ?></p>
                        <p><?php echo $product['mo_ta']; ?></p>
                        <p class="price"><?php echo $product['gia']; ?> VND</p>
                    </div>
                    <button type="button" onclick="borrowBook(<?php echo $product['id']; ?>)">
                        Mượn sách
                    </button>
                </div>

            <?php } ?>

        </div>
    </div>




    <script>
        function borrowBook(id) {

            let isLogin = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

            if (!isLogin) {

                let choice = confirm(
                    "Bạn cần đăng nhập để mượn sách.\n\nOK = Đăng nhập\nCancel = Hủy"
                );

                if (choice) {
                    window.location.href = "login.php";
                }

                return;
            }

            window.location.href = "borrow.php?id=" + id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>