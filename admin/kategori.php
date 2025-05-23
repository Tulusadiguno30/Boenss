<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>beranda- boenss admin  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">boenss</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="GET" action="kategori.php">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          </a><!-- End Notification Icon -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
        <i class="bi bi-grid"></i>
          <span>Beranda</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="kategori.php">
        <i class="bi bi-app-indicator"></i>
          <span>Kategori produk</span>
        </a>
      </li><!-- End kategori Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="produk.php">
        <i class="bi bi-bag-fill"></i>
          <span>Produk</span>
        </a>
      </li><!-- End produk Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="keranjang.php">
        <i class="bi bi-cart-check"></i>
          <span>Keranjang</span>
        </a>
      </li><!-- End keranjang Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="transaksi.php">
        <i class="bi bi-piggy-bank"></i>
          <span>Transaksi</span>
        </a>
      </li><!-- End transaksi Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="laporan.php">
        <i class="bi bi-envelope-plus-fill"></i>
          <span>Laporan</span>
        </a>
      </li><!-- End Laporan Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pengguna.php">
        <i class="bi bi-person-add"></i>
          <span>Pengguna</span>
        </a>
      </li><!-- End pengguna Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>kategori produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">beranda</a></li>
          <li class="breadcrumb-item active">kategori produk</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="row">
      <div class="col-lg-12">
       <div class="card">
        <div class="card-body">
            <a href="t_kategori.php" class="btn btn-primary mt-3">
            <i class="bi bi-plus-lg"></i> Tambah Data
            </a>
            </div>
          </div>
        </div>
      </div>

    <section class="section">
       <div class="row">
          <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA KATEGORI</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                <?php

                 include "koneksi.php";
                 $no = 1;

                 // Ambil keyword pencarian dari GET
                 $query = isset($_GET['query']) ? mysqli_real_escape_string($koneksi, $_GET['query']) : '';
                 // query dasar
                 $sql_query = "SELECT id_ktg, nm_ktg FROM tb_kategori";
                 // jika ada pencarian,tambahkan kondisi WHERE
                 if (!empty($query)) {
                    $sql_query .= " WHERE nm_ktg LIKE '%$query%'";

                 }

                 $sql = mysqli_query($koneksi, $sql_query);

                 if (mysqli_num_rows ($sql) > 0) {
                    while ($hasil = mysqli_fetch_array($sql)) {
                 ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $hasil['nm_ktg']; ?></td>
                            <td>
                                <a href="e_kategori.php?id=<?php echo $hasil['id_ktg']; ?>"class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <a href="h_kategori.php?id=<?php echo $hasil['id_ktg']; ?>"class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data?')">
                                    <i class="bi bi-trash"></i>
                              </a>
                        </td>
                       </tr>
                     <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3" class="text-center"> Data tidak ditemukan</td>
                     </tr>
                   <?php
                }
                ?>     
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>boenss</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://www.instagram.com/tuluss_adigunoo?igsh=MWw4NWN4ZHdjd2lwMQ==">Tulus adiguno</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>