<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="calonmahasiswa-update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Biodata: <span style="text-transform: uppercase;font-weight: bold;"><?= isset($user['nama']) ? $user['nama'] : 'Nama tidak tersedia'; ?></span></h3>
                </div>
                <div class="card-body">
                    <form name="update" action="<?= base_url('Mahasiswa/updatebiodata'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <!-- Tampilkan gambar profil -->
                                    <img src="<?= base_url('assets/img/profile/') . (isset($user['image']) ? $user['image'] : 'default.png'); ?>" alt="Profile Image" width="200px" id="profileImage" style="cursor: pointer;">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="image">Profile Mahasiswa</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <!-- Input hidden untuk menyimpan nama gambar lama -->
                                    <input type="hidden" name="old_image" value="<?= isset($user['image']) ? $user['image'] : 'default.png'; ?>">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="agama">Agama</label>
                                    <select id="agama" class="form-control" name="agama">
                                        <option value="" disabled <?= empty($user['agama_id']) ? 'selected' : ''; ?>>Pilih Agama</option>
                                        <?php foreach ($agama as $row) : ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $user['agama_id']) ? 'selected' : ''; ?>><?= $row['agama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="goldar">Golongan Darah</label>
                                    <select id="goldar" class="form-control" name="goldar">
                                        <option value="" disabled <?= empty($user['goldar_id']) ? 'selected' : ''; ?>>Pilih Golongan Darah</option>
                                        <?php foreach ($goldar as $row) : ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $user['goldar_id']) ? 'selected' : ''; ?>><?= $row['goldar'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= isset($user['tgl_lahir']) ? $user['tgl_lahir'] : ''; ?>">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="gender">Jenis Kelamin</label>
                                    <select id="gender" class="form-control" name="gender">
                                        <option value="L" <?= ($user['gender'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="P" <?= ($user['gender'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="telp">No Telp</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="<?= isset($user['telp']) ? $user['telp'] : ''; ?>">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($user['email']) ? $user['email'] : ''; ?>" readonly>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat"><?= isset($user['alamat']) ? $user['alamat'] : ''; ?></textarea>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?= base_url('Mahasiswa/profil'); ?>" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
