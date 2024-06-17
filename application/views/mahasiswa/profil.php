<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="calonmahasiswa-update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Biodata: <span style="text-transform: uppercase;"><?= $user['nama']; ?></span></h3>
                </div>
                <div class="card-body">
                    <form id="w0" action="/profil/updatebiodata" method="post">
                        <input type="hidden" name="_csrf" value="5mUVHTS4esRonNyWpQJ9VwJPwkSeDAu1-cWfWuHV-YCkD3htYsg3lj3fj8XPSiskbHnwJa18f-qt99AijJONxA==">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Biodata</h3>
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile Image" width="200" id="profileImage" style="cursor: pointer;">
                                </div>
                                <div class="form-group field-calonmahasiswa-noujian required">
                                    <label class="control-label" for="calonmahasiswa-nim">NIM Mahasiswa</label>
                                    <input type="text" id="calonmahasiswa-nim" class="form-control" name="Calonmahasiswa[nim]" value="<?= $mhs_data['nim_mhs']; ?>" maxlength="25" aria-required="true" readonly="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-nama required">
                                    <label class="control-label" for="calonmahasiswa-nama">Nama Mahasiswa</label>
                                    <input type="text" id="calonmahasiswa-nama" class="form-control" name="Calonmahasiswa[nama]" value="<?= $user['nama']; ?>" maxlength="25" aria-required="true" readonly="true">
                                    <div class="help-block"></div>
                                </div>
                                <!-- Form for image upload -->
                                <div class="form-group">
                                    <label class="control-label" for="imageInput">Gambar Profile</label>
                                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-kodeagama required">
                                    <label class="control-label" for="agama">Agama</label>
                                    <select id="agama" class="form-control" name="agama" aria-required="true">
                                        <option value="" disabled <?= empty($user['agama']) ? 'selected' : ''; ?>>Pilih Agama</option>
                                        <?php foreach ($agama as $ag) : ?>
                                            <option value="<?= $ag['id']; ?>" <?= $ag['id'] == $user['agama'] ? 'selected' : ''; ?>><?= $ag['agama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-goldar">
                                    <label class="control-label" for="calonmahasiswa-goldar">Golongan Darah</label>
                                    <select id="calonmahasiswa-goldar" class="form-control" name="Calonmahasiswa[goldar]">
                                        <option value="" disabled <?= empty($user['goldar']) ? 'selected' : ''; ?>>Pilih Goldar</option>
                                        <?php foreach ($goldar as $g) : ?>
                                            <option value="<?= $g['id']; ?>" <?= $g['id'] == $user['goldar'] ? 'selected' : ''; ?>><?= $g['goldar']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-tempatlahir required">
                                    <label class="control-label" for="calonmahasiswa-tempatlahir">Tempat Lahir</label>
                                    <input type="text" id="calonmahasiswa-tempatlahir" class="form-control" name="Calonmahasiswa[tempatlahir]" value="<?= $user['tempat_lahir']; ?>" maxlength="200" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-tgllhrmhs required">
                                    <label class="control-label" for="calonmahasiswa-tgllhrmhs">Tanggal Lahir Mahasiswa (Tahun-Bulan-Tanggal)</label>
                                    <input type="date" id="calonmahasiswa-tgllhrmhs" class="form-control" name="Calonmahasiswa[tgllhrmhs]" value="<?= $user['tgl_lahir']; ?>" placeholder="Pilih Tanggal Lahir Mahasiswa" style="cursor: pointer;">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-jeniskelamin">
                                    <label class="control-label" for="calonmahasiswa-jeniskelamin">Jenis Kelamin</label>
                                    <select id="calonmahasiswa-jeniskelamin" class="form-control" name="Calonmahasiswa[jeniskelamin]">
                                        <option value="P" <?= $user['gender'] == 2 ? 'selected' : ''; ?>>PEREMPUAN</option>
                                        <option value="L" <?= $user['gender'] == 1 ? 'selected' : ''; ?>>LAKI-LAKI</option>
                                        <option value="-" <?= $user['gender'] == 0 ? 'selected' : ''; ?>>BELUM DIISI</option>
                                    </select>
                                </div>
                                <div class="form-group field-calonmahasiswa-nohp required">
                                    <label class="control-label" for="calonmahasiswa-nohp">No HP</label>
                                    <input type="text" id="calonmahasiswa-nohp" class="form-control" name="Calonmahasiswa[nohp]" value="<?= $user['telp']; ?>" maxlength="25" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-email required">
                                    <label class="control-label" for="calonmahasiswa-email">Email Mahasiswa</label>
                                    <input type="text" id="calonmahasiswa-email" class="form-control" name="Calonmahasiswa[email]" value="<?= $user['email']; ?>" maxlength="50" aria-required="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-alamatasalmhs">
                                    <label class="control-label" for="calonmahasiswa-alamatasalmhs">Alamat Mahasiswa</label>
                                    <textarea id="calonmahasiswa-alamatasalmhs" class="form-control" name="Calonmahasiswa[alamatasalmhs]" rows="3"><?= $user['alamat']; ?></textarea>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a class="btn btn-secondary" href="/site/index">Kembali</a>
                                </div>

                            </div>

                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>