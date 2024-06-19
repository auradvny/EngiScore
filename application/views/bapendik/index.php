<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="<?php echo base_url() ?>assets/template/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plus"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Mahasiswa</span>
                            <span class="info-box-number">
                                <?= $jumlah_mhs ?> <small>orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-export" style="color: #ffffff;"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Permohonan Diajukan</span>
                            <span class="info-box-number">
                                <?= $jumlah_permo ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Permohonan Disetujui</span>
                            <span class="info-box-number">
                                <?= $jumlah_permosetuju ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times" style="color: #ffffff;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Permohonan Ditolak</span>
                            <span class="info-box-number">
                                <?= $jumlah_permotolak ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Biodata</h3>
                </div>
                <div class="row">
                    <div class="col-md-2 text-center card-body box-profile">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" width="170px" />
                    </div>

                    <div class="col-md-10">
                        <table class="table table-sm ">
                            <td width="15%">NIP</td>
                            <td width="2%">:</td>
                            <td><?= $user['nip']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?= $user['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><?= $user['telp']; ?></td>
                            </tr>
                            <tr>
                                <td>E-Mail</td>
                                <td>:</td>
                                <td><?= $user['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= $user['gender']; ?></td>
                            </tr>
                            <tr>
                                <td>Status Kini</td>
                                <td>:</td>
                                <td><?php
                                    if ($user['is_active'] == 1) {
                                        echo 'Aktif';
                                    } elseif ($user['is_active'] == 0) {
                                        echo 'Tidak Aktif';
                                    } else {
                                        echo 'Status Tidak Diketahui';
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Bergabung Sejak</td>
                                <td>:</td>
                                <td><?= date('d F Y', $user['tgl_dibuat']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->