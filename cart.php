<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biolife - Organic Food</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main-color.css">
</head>
<body class="biolife-body">

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

       <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 d-flex align-items-center">
                        <a href="index.php" class="biolife-logo"><img src="assets/images/favicon.png"
                                alt="biolife logo">
                            <b style="font-size: 150% ; color: black;">boenss</b></a>
                    </div>

                    <div class="col-lg-6 col-md-6 d-none d-md-block text-center">
                        <div class="primary-menu">
                            <ul>
                                <li class="menu-item"><a href="index.php">Beranda</a></li>
                                <li>
                                    <a href="belanja.php">Belanja</a>
                                </li>
                                <li class="menu-item"><a href="contact.php">Hubungi Kami</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-end align-items-center">
                        <div class="biolife-cart-info">
                            <div class="mobile-search">
                                <a href="javascript:void(0)" class="open-searchbox"><i
                                        class="biolife-icon icon-search"></i></a>
                                <div class="mobile-search-content">
                                    <form action="#" class="form-search" name="mobile-seacrh" method="get">
                                        <a href="#" class="btn-close"><span
                                                class="biolife-icon icon-close-menu"></span></a>
                                        <input type="text" name="s" class="input-text" value=""
                                            placeholder="Search here...">
                                        <select name="category">
                                            <option value="-1" selected>All Categories</option>
                                            <option value="vegetables">Vegetables</option>
                                            <option value="fresh_berries">Fresh Berries</option>
                                            <option value="ocean_foods">Ocean Foods</option>
                                            <option value="butter_eggs">Butter & Eggs</option>
                                            <option value="fastfood">Fastfood</option>
                                            <option value="fresh_meat">Fresh Meat</option>
                                            <option value="fresh_onion">Fresh Onion</option>
                                            <option value="papaya_crisps">Papaya & Crisps</option>
                                            <option value="oatmeal">Oatmeal</option>
                                        </select>
                                        <button type="submit" class="btn-submit">go</button>
                                    </form>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['username'])): ?>
                                <?php
                                include 'admin/koneksi.php';
                                $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

                                if ($user_id) {
                                    $query = "SELECT COUNT(*) as total FROM tb_pesanan WHERE id_user = '$user_id'";
                                    $result = mysqli_query($koneksi, $query);
                                    $data = mysqli_fetch_assoc($result);
                                    $jumlah_item = isset($data['total']) ? $data['total'] : 0;
                                } else {
                                    $jumlah_item = 0;
                                }
                                ?>
                                <div class="minicart-block">
                                    <div class="minicart-contain">
                                        <a href="javascript:void(0)" class="link-to">
                                            <span class="icon-qty-combine">
                                                <i class="icon-cart-mini biolife-icon"></i>
                                                <span class="qty"><?= $jumlah_item ?></span>
                                            </span>
                                            <span class="title">Keranjang</span>
                                        </a>
                                        <div class="cart-content">
                                            <div class="cart-inner">
                                                <ul class="products">
                                                    <?php
                                                    include 'admin/koneksi.php';
                                                    $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

                                                    if ($user_id) {
                                                        $query = "SELECT p.*, pr.nm_produk, pr.harga, pr.gambar 
                    FROM tb_pesanan p 
                    JOIN tb_produk pr ON p.id_produk = pr.id_produk 
                    WHERE p.id_user = '$user_id'";
                                                        $result = mysqli_query($koneksi, $query);
                                                        $subtotal = 0;

                                                        while ($row = mysqli_fetch_assoc($result)):
                                                            $total_harga = $row['harga'] * $row['qty'];
                                                            $subtotal += $total_harga;
                                                            ?>
                                                            <li>
                                                                <div class="minicart-item">
                                                                    <div class="thumb">
                                                                        <a href="#"><img
                                                                                src="admin/produk_img/<?= $row['gambar'] ?>"
                                                                                width="90" height="90"
                                                                                alt="<?= $row['nm_produk'] ?>"></a>
                                                                    </div>
                                                                    <div class="left-info">
                                                                        <div class="product-title"><a href="#"
                                                                                class="product-name"><?= $row['nm_produk'] ?></a>
                                                                        </div>
                                                                        <div class="price">
                                                                            <ins><span class="price-amount"><span
                                                                                        class="currencySymbol">Rp.</span><?= number_format($row['harga'], 0, ',', '.') ?></span></ins>
                                                                        </div>
                                                                        <div class="qty">
                                                                            <label>Qty:</label>
                                                                            <input type="number" class="input-qty"
                                                                                value="<?= $row['qty'] ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <a href="hapus_item.php?id=<?= $row['id_pesanan'] ?>"><i
                                                                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        endwhile;
                                                    } else {
                                                        echo '<li><p style="padding: 10px;">Keranjang kosong.</p></li>';
                                                        $subtotal = 0;
                                                    }
                                                    ?>
                                                </ul>

                                                <p class="btn-control">
                                                    <a href="cart.php" class="btn view-cart">Lihat Keranjang</a>
                                                    <a href="#" class="btn" onclick="checkout()">checkout</a>
                                                    <div class="minicart-block">
                                <div class="minicart-contain">
                                    <a href="javascript:void(0)" class="link-to">
                                            <span class="icon-qty-combine">
                                                <i class="icon-cart-mini biolife-icon"></i>
                                                <span class="qty">0</span>
                                            </span>
                                        
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown user wishlist-block hidden-sm hidden-xs">
                                    <a class="dropdown-toggle d-flex align-items-center link-to" href="#" id="userDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon-qty-combine">
                                            <i class="fas fa-user biolife-icon"></i>
                                            <span class="qty"><?= htmlspecialchars($_SESSION['username']);  ?></span>
                                            <!-- Ganti qty jadi username -->
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <ul class="logout-list">
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Login Button (shown if not logged in) -->
                                <div class="login-button">
                                    <a href="login.php" class="btn btn-sm btn-outline-primary">Login</a>
                                </div>
                            <?php endif; ?>
                            <div class="mobile-menu-toggle">
                                <a class="btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="vertical-menu vertical-category-block">

                            <div class="wrap-menu">
                                <ul class="menu clone-main-menu">
                                    <?php
                                    include "admin/koneksi.php";
                                    $kategori_result = mysqli_query($koneksi, "SELECT * FROM tb_kategori ORDER BY nm_kategori ASC");
                                    while ($kategori = mysqli_fetch_assoc($kategori_result)) {
                                        $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $kategori['id_kategori']) ? 'style="font-weight:bold;"' : '';
                                        echo '<li class="menu-item"><a href="?kategori=' . $kategori['id_kategori'] . '" class="menu-title" ' . $selected . '>' . $kategori['nm_kategori'] . '</a></li>';
                                    }
                                    ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 padding-top-2px">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
   
    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">belanja</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">beranda</a></li>
                <li class="nav-item"><span class="current-page">keranjang</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">


                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">keranjang anda</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>                                   
                                      <tr>
                                        <th class="product-name">nama produk</th>
                                        <th class="product-price">harga</th>
                                        <th class="product-quantity">jumlah</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    include 'admin/koneksi.php';

                                    if (!isset($_SESSION['id_user'])) {
                                        //kalau belum login,redirect (opsional)
                                        header("location:login.php");
                                        exit;
                                    }
                                    
                                    
                                    <tbody>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail" data-title="Product Name">
                                            <a class="prd-thumb" href="#">
                                                <figure><img width="113" height="113" src="assets/images/shippingcart/pr-01.jpg" alt="shipping cart"></figure>
                                            </a>
                                            <a class="prd-name" href="#">National Fresh Fruit</a>
                                            <div class="action">
                                                <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                                                    <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                    <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail" data-title="Product Name">
                                            <a class="prd-thumb" href="#">
                                                <figure><img width="113" height="113" src="assets/images/shippingcart/pr-02.jpg" alt="shipping cart"></figure>
                                            </a>
                                            <a class="prd-name" href="#">National Fresh Fruit</a>
                                            <div class="action">
                                                <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                                                    <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                    <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="cart_item wrap-buttons">
                                        <td class="wrap-btn-control" colspan="4">
                                            <a class="btn back-to-shop">Back to Shop</a>
                                            <button class="btn btn-update" type="submit" disabled>update</button>
                                            <button class="btn btn-clear" type="reset">clear all</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">(2ittems)</span></b>
                                    <span class="stt-price">£170.00</span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">£0.00</span>
                                </div>
                                <div class="tax-fee">
                                    <p class="title">Est. Taxes & Fees</p>
                                    <p class="desc">Based on 56789</p>
                                </div>
                                <div class="btn-checkout">
                                    <a href="#" class="btn checkout">Check out</a>
                                </div>
                                <div class="biolife-progress-bar">
                                    <table>
                                        <tr>
                                            <td class="first-position">
                                                <span class="index">$0</span>
                                            </td>
                                            <td class="mid-position">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="last-position">
                                                <span class="index">$99</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping and pickup</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <script>
        function checkout() {
            if (confirm("Yakin ingin checkout sekarang?")) {
                fetch('checkout.php', {
                    method: 'POST'
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            window.location.href = "belanja.php";
                        }
                    })
                    .catch(error => {
                        alert("Terjadi kesalahan saat proses checkout.");
                        console.error(error);
                    });
            }
        }
    </script>
                <!--Related Product-->
                <div class="product-related-box single-layout">
                    <div class="biolife-title-box lg-margin-bottom-26px-im">
                    </div>
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-15.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-08.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-21.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="assets/images/products/p-18.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Fresh Fruit</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                        <div class="buttons">
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

  <!-- FOOTER -->
    <footer id="footer" class="footer layout-03">
        <div class="footer-content background-footer-03">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-9">
                        <section class="footer-item">
                           <a href="index.php" class="biolife-logo"><img src="assets/images/favicon.png"
                                alt="biolife logo">
                            <b style="font-size: 150% ; color: black;">boenss</b></a>
                            <div class="footer-phone-info">
                                <i class="biolife-icon icon-head-phone"></i>
                                <p class="r-info">
                                    <span>ada pertanyaan?</span>
                                    <span>085695449330</span>
                                </p>
                            </div>
                         
                        </section>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                     
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                        <section class="footer-item">
                            <h3 class="section-title">layanan Transportasi</h3>
                            <div class="contact-info-block footer-layout xs-padding-top-10px">
                                <ul class="contact-lines">
                                    <li>
                                        <p class="info-item">
                                            <i class="biolife-icon icon-location"></i>
                                            <b class="desc">cepu-blora,jawa tengah,indonesia </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="info-item">
                                            <i class="biolife-icon icon-phone"></i>
                                            <b class="desc">Phone:0856-9544-9330</b>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="info-item">
                                            <i class="biolife-icon icon-letter"></i>
                                            <b class="desc">Email:  boenss@gmail.com</b>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="info-item">
                                            <i class="biolife-icon icon-clock"></i>
                                            <b class="desc">jam buka;setiap hari mulai pukul 08:00</b>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="biolife-social inline">
                                <ul class="socials">

                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="separator sm-margin-top-70px xs-margin-top-40px"></div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                       <div class="copy-right-text"><p><a href="templateshub.net">Templates Hub</a></p></div>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="payment-methods">
                            <ul>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--Footer For Mobile-->
    <div class="mobile-footer">
        <div class="mobile-footer-inner">
            <div class="mobile-block block-menu-main">
                <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                    <span class="fa fa-bars"></span>
                    <span class="text">Menu</span>
                </a>
            </div>
            <div class="mobile-block block-sidebar">
                <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                    <i class="fa fa-sliders" aria-hidden="true"></i>
                    <span class="text">Sidebar</span>
                </a>
            </div>
            <div class="mobile-block block-minicart">
                <a class="link-to-cart" href="#">
                    <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                    <span class="text">Cart</span>
                </a>
            </div>
            <div class="mobile-block block-global">
                <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                    <span class="fa fa-globe"></span>
                    <span class="text">Global</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mobile-block-global">
        <div class="biolife-mobile-panels">
            <span class="biolife-current-panel-title">Global</span>
            <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
        </div>
        <div class="block-global-contain">
            <div class="glb-item my-account">
                <b class="title">My Account</b>
                <ul class="list">
                    <li class="list-item"><a href="#">Login/register</a></li>
                    <li class="list-item"><a href="#">Wishlist <span class="index">(8)</span></a></li>
                    <li class="list-item"><a href="#">Checkout</a></li>
                </ul>
            </div>
            <div class="glb-item currency">
                <b class="title">Currency</b>
                <ul class="list">
                    <li class="list-item"><a href="#">€ EUR (Euro)</a></li>
                    <li class="list-item"><a href="#">$ USD (Dollar)</a></li>
                    <li class="list-item"><a href="#">£ GBP (Pound)</a></li>
                    <li class="list-item"><a href="#">¥ JPY (Yen)</a></li>
                </ul>
            </div>
            <div class="glb-item languages">
                <b class="title">Language</b>
                <ul class="list inline">
                    <li class="list-item"><a href="#"><img src="assets/images/languages/us.jpg" alt="flag" width="24" height="18"></a></li>
                    <li class="list-item"><a href="#"><img src="assets/images/languages/fr.jpg" alt="flag" width="24" height="18"></a></li>
                    <li class="list-item"><a href="#"><img src="assets/images/languages/ger.jpg" alt="flag" width="24" height="18"></a></li>
                    <li class="list-item"><a href="#"><img src="assets/images/languages/jap.jpg" alt="flag" width="24" height="18"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function checkout() {
            if (confirm("Yakin ingin checkout sekarang?")) {
                fetch('checkout.php', {
                    method: 'POST'
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            window.location.href = "belanja.php";
                        }
                    })
                    .catch(error => {
                        alert("Terjadi kesalahan saat proses checkout.");
                        console.error(error);
                    });
            }
        }
    </script>

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/biolife.framework.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>