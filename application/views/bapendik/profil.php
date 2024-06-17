<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="calonbapendik-update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Biodata: <span style="text-transform: uppercase;font-weight: bold;"><?= $user['nama']; ?></span></h3>
                </div>
                <div class="card-body">
                    <form name="update" action="<?php echo base_url('Bapendik/updatebiodata'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile Image" width="200px" id="profileImage" style="cursor: pointer;">
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
                                <!-- <div class="form-group required">
                                    <label class="control-label" for="tempat_lahir">Tempat Lahir Mahasiswa</label>
                                    <input type=" text" id="tempat_lahir" class=" form-control" name="calonbapendik[tempatlahir]" value="<?= $user['tempat_lahir']; ?>" maxlength="200" aria-required="true">
                                    <div class="help-block"></div>
                                </div> -->
                                <div class="form-group required">
                                    <label class="control-label" for="tgl_lahir">Tanggal Lahir Pegawai (Tahun-Bulan-Tanggal)</label>
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
                                    <label class="control-label" for="telp">No HP Pegawai</label>
                                    <input type="text" id="telp" class="form-control" name="telp" value="<?= $user['telp']; ?>" maxlength="25" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="email">Email Pegawai</label>
                                    <input type="text" id="email" class="form-control" name="email" value="<?= $user['email']; ?>" maxlength="50" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="alamat">Alamat Pegawai</label>
                                    <textarea id="alamat" class="form-control" name="alamat" rows="2"><?= $user['alamat']; ?></textarea>

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
    </div><!-- /.container-fluid -->
</div>