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
                            <span class="info-box-text">Jumlah Poin</span>
                            <span class="info-box-number">
                                <?= $points ?>
                                point
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
                            <span class="info-box-text">Pengajuan Permohonan</span>
                            <span class="info-box-number"><?= $jumlah_pengajuan ?> buah</span>
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
                            <span class="info-box-number"><?= $jumlah_permosetuju ?> buah</span>
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
                            <span class="info-box-number"><?= $jumlah_permotolak ?> buah</span>
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
                            <td width="15%">NIM</td>
                            <td width="2%">:</td>
                            <td><?= $mhs_data['nim_mhs']; ?></td>
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
                                <td>Fakultas</td>
                                <td>:</td>
                                <td><?= $mhs_data['fakultas']; ?></td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td><?= $mhs_data['prodi']; ?></td>
                            </tr>
                            <tr>
                                <td>Pembiayaan</td>
                                <td>:</td>
                                <td><?= $mhs_data['pembiayaan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status Kini</td>
                                <td>:</td>
                                <td><?php
                                    if ($user['is_active'] == 1) {
                                        echo 'Aktif';
                                    } elseif ($user['is_active'] == 2) {
                                        echo 'Tidak Aktif';
                                    } else {
                                        echo 'Status Tidak Diketahui';
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Cuti</td>
                                <td>:</td>
                                <td><?= $mhs_data['cuti']; ?></td>
                            </tr>
                            <tr>
                                <td>Pembimbing Akademik</td>
                                <td>:</td>
                                <td><?= $mhs_data['pa']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
