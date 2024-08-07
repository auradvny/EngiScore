<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Engine Score</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/page/vendor/animate.css/animate.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/page/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/page/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/page/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/page/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/page/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?= base_url('assets/page/css/style.css') ?>">

  <style>
    #header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    body {
      padding-top: 80px;
      /* Adjust the value to the height of the header */
    }

    .navbar .nav-link.active {
      color: #7D8ABC;
      /* Warna untuk link aktif */
      font-weight: bold;
      text-decoration: underline;
      /* Garis bawah untuk link aktif */
    }

    .navbar .nav-link.active:hover {
      text-decoration: underline;
      /* Garis bawah tetap ada saat link aktif dihover */
    }

    #footer {
      padding: 10px 0;
      /* Adjust the padding as needed */
      background-color: #343a40;
      /* Example background color */
    }

    #footer p {
      margin: 5px 0;
      /* Atur jarak margin atas dan bawah menjadi 5px, dan 0 untuk margin kiri dan kanan */
      color: white;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center" style="background-color: white;">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <div class="logo me-auto"> <!-- Tambahkan padding kiri pada logo -->
        <h1>
          <img src="<?= base_url('assets/template/') ?>Logo-UNSOED.png" alt="" style="padding-right: 10px;padding-bottom: 10px;">
          <a href="index.html" style="color: black; font-family:Georgia, 'Times New Roman', Times, serif;">EngiScore</a>
        </h1>
      </div>

      <!-- Navbar -->
      <nav id="navbar" class="navbar navbar-expand-lg" style="padding-right: 3%;">
        <div class="container-fluid justify-content-center"> <!-- Menggunakan container-fluid dan justify-content-center untuk navbar -->
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link scrollto" href="#hero" style="color: black;">Home</a></li>
            <li class="nav-item"><a class="nav-link scrollto" href="#contact" style="color: black;">Contact</a></li>
          </ul>
        </div>
      </nav>

      <a href="<?= base_url('auth'); ?>" style="background-color: #304463; padding: 10px 20px; color: white; text-decoration: none;">Login</a>

    </div>
  </header><!-- End Header -->

  <!-- Your content goes here -->

  <!-- Template Main JS File -->
</body>

</html>