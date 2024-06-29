<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="calonbapendik-update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Biodata: <span style="text-transform: uppercase;font-weight: bold;"><?= $user['nama']; ?></span></h3>
                </div>
                <div class="card-body">
                    <div class="flashdata-message">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <form name="update" action="<?php echo base_url('Bapendik/updatebiodata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <!-- Link untuk tampilkan gambar dalam modal -->
                                    <a href="#" data-toggle="modal" data-target="#modalGambarProfil">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile Image" width="200px" id="profileImage" style="cursor: pointer;">
                                    </a>
                                </div>

                                <!-- Modal untuk gambar profil -->
                                <div class="modal fade" id="modalGambarProfil" tabindex="-1" aria-labelledby="modalGambarProfilLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalGambarProfilLabel"><span style="text-transform: uppercase;font-weight: bold;"><?= $user['nama']; ?></span></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile Image" style="max-width: 100%; max-height: 70vh;">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="btn btn-primary" download>Unduh</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="nip">NIP Pegawai</label>
                                    <input type=" text" id="nip" class=" form-control" name="nip" value=" <?= $user['nip']; ?>" maxlength="25" aria-required="true" readonly="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="nama">Nama Pegawai</label>
                                    <input type="text" id="nama" class="form-control" name="nama" value="<?= $user['nama']; ?>" maxlength="25" aria-required="true" readonly="true" style="text-transform: uppercase">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="email">Email Pegawai</label>
                                    <input type="text" id="email" class="form-control" name="email" value="<?= $user['email']; ?>" maxlength="50" aria-required="true" readonly="true" style="text-transform: uppercase">
                                    <div class="help-block"></div>
                                </div>
                                <!-- Form for image upload -->
                                <div class="form-group">
                                    <label class="control-label" for="image">Profile Pegawai</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="agama">Agama</label>
                                    <select id="agama" class="form-control" name="agama" aria-required="true">
                                        <option value="" disabled <?= empty($user['agama_id']) ? 'selected' : ''; ?>>Pilih Agama</option>
                                        <?php foreach ($agama as $ag) : ?>
                                            <option value="<?= $ag['id']; ?>" <?= $ag['id'] == $user['agama_id'] ? 'selected' : ''; ?>><?= $ag['agama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="goldar">Golongan Darah</label>
                                    <select id="goldar" class="form-control" name="goldar">
                                        <option value="" disabled <?= empty($user['goldar_id']) ? 'selected' : ''; ?>>Pilih Goldar</option>
                                        <?php foreach ($goldar as $g) : ?>
                                            <option value="<?= $g['id']; ?>" <?= $g['id'] == $user['goldar_id'] ? 'selected' : ''; ?>><?= $g['goldar']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="tgl_lahir">Tanggal Lahir Pegawai</label>
                                    <input type="date" id="tgl_lahir" class="form-control" name="tgl_lahir" value="<?= $user['tgl_lahir']; ?>" placeholder="Pilih Tanggal Lahir Mahasiswa" style="cursor: pointer;">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="gender">Gender</label>
                                    <select id="gender" class="form-control" name="gender">
                                        <option value="" disabled <?= empty($user['gender']) ? 'selected' : ''; ?>>Pilih Gender</option>
                                        <option value="L" <?= $user['gender'] == 'L' ? 'selected' : ''; ?>>LAKI-LAKI</option>
                                        <option value="P" <?= $user['gender'] == 'P' ? 'selected' : ''; ?>>PEREMPUAN</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="telp">No Telepon</label>
                                    <input type="text" id="telp" class="form-control" name="telp" value="<?= $user['telp']; ?>" maxlength="25" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="alamat">Alamat Pegawai</label>
                                    <textarea id="alamat" class="form-control" name="alamat" rows="2" style="text-transform: uppercase"><?= $user['alamat']; ?></textarea>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <!-- <a class="btn btn-secondary" href="bapendik/profil">Kembali</a> -->
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.row -->

        <div class="calonbapendikpass-update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Password: <span style="text-transform: uppercase;font-weight: bold;"><?= $user['nama']; ?></span></h3>
                </div>
                <div class="card-body">
                    <div class="flashdata-message">
                        <?= $this->session->flashdata('pesan'); ?>
                    </div>
                    <form name="update" action="<?php echo base_url('Bapendik/updatepassword'); ?>" method="post">
                        <input type="hidden" name="_csrf">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Password update section -->
                                <div class="form-group required">
                                    <label class="control-label" for="current_password">Password Saat Ini</label>
                                    <input type="password" id="current_password" class="form-control" name="current_password" aria-required="true">
                                    <div class="help-block"></div>
                                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="new_password">Password Baru</label>
                                    <input type="password" id="new_password" class="form-control" name="new_password" aria-required="true">
                                    <div class="help-block"></div>
                                    <?= form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="confirm_password">Konfirmasi Password Baru</label>
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" aria-required="true">
                                    <div class="help-block"></div>
                                    <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <!-- <a class="btn btn-secondary" href="bapendik/profil">Kembali</a> -->
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>