<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistem Point | <?= $title ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/dist/css/adminlte.min.css">

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    /* Style untuk header fixed */
    .main-header {
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1030;
      /* Menentukan layer stacking order */
    }

    /* Style untuk footer solid */
    footer {
      position: fixed;
      bottom: 0px;
      width: 100%;
      z-index: 1030;
      /* Menentukan layer stacking order */

    }

    /* Style untuk konten utama */
    .content-wrapper {
      margin-top: 55px;
      /* Sesuaikan dengan tinggi header Anda */
      margin-bottom: 55px;
      /* Sesuaikan dengan tinggi footer Anda */
      padding: 5px;
    }

    #time-box {
      /* background-color: #2E3B4E; */
      background-color: #304463;
      color: #FFFFFF;
      padding: 10px;
      border-radius: 5px;
      text-align: center;
      font-family: 'Arial', sans-serif;
    }

    #current-date {
      font-size: 14px;
      margin-bottom: 5px;
    }

    #current-time {
      font-size: 24px;
      font-weight: bold;
    }

    .sidebar-active {
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
      /* Bayangan putih transparan */
    }

    .navbar .nav-link.active {
      position: relative;
      /* Membuat posisi relatif untuk elemen */
      color: #7D8ABC;
      /* Warna teks untuk link aktif */
      text-decoration: none;
      /* Hapus garis bawah bawaan */
      padding-bottom: 2px;
      /* Jarak antara teks dan garis bawah */
    }

    .navbar .nav-link.active::after {
      content: '';
      /* Konten tambahan untuk garis bawah */
      position: absolute;
      /* Posisi absolut untuk elemen tambahan */
      left: 0;
      /* Mulai dari kiri */
      bottom: 0;
      /* Di bagian bawah teks */
      width: 100%;
      /* Lebar sepanjang teks */
      height: 2px;
      /* Tinggi garis bawah */
      background-image: linear-gradient(120deg, #7D8ABC, #81A1C1);
      /* Gradient warna */
    }
  </style>