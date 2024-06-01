<form action="<?= base_url('bapendik/tambah_aksi') ?>" method="POST">
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" name="nim_mhs" id="nim_mhs" class="form-control" placeholder="NIM Mahasiswa" value="<?= set_value('nim_mhs'); ?>">
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
        <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email">Email Mahasiswa</label>
        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
        <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <!-- <div class="form-group">
        <label for="pass">Password Mahasiswa</label>
        <input type="text" name="pass" class="form-control">
        <?= form_error('pass', '<div class="text-small text-danger">', '</div>'); ?>
    </div> -->
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <div>
            <input type="radio" name="gender" value="L" <?= set_value('gender') == 'L' ? 'checked' : ''; ?>>Laki-Laki
            <input type="radio" name="gender" value="P" <?= set_value('gender') == 'P' ? 'checked' : ''; ?>>Perempuan
        </div>
        <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <!-- tb_mhs (prodi_id) dari tb_prodi -->
    <div class="form-group">
        <label for="prodi">Prodi Mahasiswa</label>
        <select name="prodi_id" id="prodi_id" class="form-control">
            <option value="">Pilih Prodi</option>
            <?php foreach ($prodi as $p) : ?>
                <option value="<?= $p['id']; ?>" <?= set_value('prodi_id') == $p['id'] ? 'selected' : ''; ?>><?= $p['prodi']; ?></option> <?php endforeach; ?>
        </select>
        <?= form_error('prodi', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp">No Telp Mahasiswa</label>
        <input type="text" name="telp" class="form-control" value="<?= set_value('telp'); ?>">
        <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <!-- <div class="form-group">
        <label for="alamat">Alamat Mahasiswa</label>
        <textarea name="alamat" id="alamat" class="form-control"></textarea>
        <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
    </div> -->

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Reset</button>
</form>