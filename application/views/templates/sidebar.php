<body class="hold-transition sidebar-mini" id="page-top">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <?php if ($this->session->userdata('role_id') == 1) : ?>
            <a href="<?= base_url('mahasiswa'); ?>" class="nav-link">Home</a>
          <?php elseif ($this->session->userdata('role_id') == 2) : ?>
            <a href="<?= base_url('bapendik'); ?>" class="nav-link">Home</a>
          <?php elseif ($this->session->userdata('role_id') == 3) : ?>
            <a href="<?= base_url('pimpinan'); ?>" class="nav-link">Home</a>
          <?php endif; ?>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('welcome'); ?>" class="nav-link">Contact</a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <?php if ($this->session->userdata('role_id') == 1) : ?>
        <a href="<?= base_url('mahasiswa'); ?>" class="brand-link">
        <?php elseif ($this->session->userdata('role_id') == 2) : ?>
          <a href="<?= base_url('bapendik'); ?>" class="brand-link">
          <?php elseif ($this->session->userdata('role_id') == 3) : ?>
            <a href="<?= base_url('pimpinan'); ?>" class="brand-link">
            <?php endif; ?> <img src="<?= base_url('assets/template/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">EngiScore</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <?php if ($this->session->userdata('role_id') == 1) : ?>
                    <a href="<?= base_url('mahasiswa/profil'); ?>" class="d-block"><?= $user['nama']; ?></a>
                  <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                    <a href="<?= base_url('bapendik/profil'); ?>" class="d-block"><?= $user['nama']; ?></a>
                  <?php elseif ($this->session->userdata('role_id') == 3) : ?>
                    <a href="<?= base_url('pimpinan/profil'); ?>" class="d-block"><?= $user['nama']; ?></a>
                  <?php endif; ?>
                </div>
              </div>

              <!-- SidebarSearch Form -->
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                    <?php if ($this->session->userdata('role_id') == 1) : ?>
                      <a href="<?= base_url('mahasiswa'); ?>" class="nav-link">
                      <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                        <a href="<?= base_url('bapendik'); ?>" class="nav-link">
                        <?php elseif ($this->session->userdata('role_id') == 3) : ?>
                          <a href="<?= base_url('pimpinan'); ?>" class="nav-link">
                          <?php endif; ?> <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>Dashboard</p>
                          </a>
                  </li>

                  <?php
                  $role_id = $this->session->userdata('role_id');

                  $queryMenu = "SELECT tb_user_menu.id, menu 
            FROM tb_user_menu JOIN tb_user_akses_menu 
            ON tb_user_menu.id = tb_user_akses_menu.menu_id 
            WHERE tb_user_akses_menu.role_id = $role_id 
            ORDER BY tb_user_akses_menu.menu_id ASC 
            ";
                  $menu = $this->db->query($queryMenu)->result_array();
                  ?>

                  <!-- Looping Menu -->
                  <?php foreach ($menu as $m) : ?>
                    <div class="sidebar-heading">
                      <?= $m['menu']; ?>
                    </div>


                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
            FROM tb_user_sub_menu JOIN tb_user_menu 
            ON tb_user_sub_menu.menu_id = tb_user_menu.id 
            WHERE tb_user_sub_menu.menu_id = $menuId
            AND tb_user_sub_menu.is_active = 1
            ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>

                    <?php foreach ($subMenu as $sm) : ?>
                      <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a href="<?= base_url(($this->session->userdata('role_id') == 1 ? 'mahasiswa/' : ($this->session->userdata('role_id') == 2 ? 'bapendik/' : 'pimpinan/')) . $sm['url']); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'dashboard') echo 'active' ?>">
                          <i class="<?= $sm['icon']; ?>"></i>
                          <p><?= $sm['title']; ?></p>
                        </a>
                        </li>
                      <?php endforeach; ?>
                    <?php endforeach; ?>

                    <hr class="sidebar-divider">

                    <li class="nav-item">
                      <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                      </a>
                    </li>
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" class="d-flex flex-column">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <?php if ($this->session->userdata('role_id') == 1) : ?>
                    <a href="<?= base_url('mahasiswa'); ?>">Home</a>
                  <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                    <a href="<?= base_url('bapendik'); ?>">Home</a>
                  <?php elseif ($this->session->userdata('role_id') == 3) : ?>
                    <a href="<?= base_url('pimpinan'); ?>">Home</a>
                  <?php endif; ?>
                </li>
                <li class="breadcrumb-item active"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">