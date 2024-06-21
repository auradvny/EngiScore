<form action="<?= base_url('bapendik/tambah_mhs') ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
        <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email">Email Mahasiswa</label>
        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Mahasiswa" value="<?= set_value('email'); ?>">
        <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" name="nim_mhs" id="nim_mhs" class="form-control" placeholder="NIM Mahasiswa" value="<?= set_value('nim_mhs'); ?>">
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <div>
            <input type="radio" name="gender" value="L" <?= set_value('gender') == 'L' ? 'checked' : ''; ?>> Laki-Laki
            <input type="radio" name="gender" value="P" <?= set_value('gender') == 'P' ? 'checked' : ''; ?>> Perempuan
        </div>
        <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="prodi_id">Prodi Mahasiswa</label>
        <select name="prodi_id" id="prodi_id" class="form-control">
            <option value="" disabled <?= empty($user['prodi_id']) ? 'selected' : ''; ?>>Pilih Prodi</option>
            <?php foreach ($prodi as $p) : ?>
                <option value="<?= $p['id']; ?>" <?= set_value('prodi_id') == $p['id'] ? 'selected' : ''; ?>><?= $p['prodi']; ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('prodi_id', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp">No Telp Mahasiswa</label>
        <input type="text" name="telp" class="form-control" value="<?= set_value('telp'); ?>" placeholder="No Telp Mahasiswa">
        <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="image">Gambar</label>
        <input type="file" class="form-control" id="image" name="image">
        <?= form_error('image', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pembiayaan">Pembiayaan</label>
        <select name="pembiayaan" id="pembiayaan" class="form-control">
            <option value="" disabled <?= empty($user['pembiayaan']) ? 'selected' : ''; ?>>Pilih Pembiayaan</option>
            <option value="biaya_sendiri" <?= set_value('pembiayaan') == 'biaya_sendiri' ? 'selected' : ''; ?>>Biaya Sendiri</option>
            <option value="pemerintah" <?= set_value('pembiayaan') == 'pemerintah' ? 'selected' : ''; ?>>Pemerintah</option>
        </select>
        <?= form_error('pembiayaan', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pa">Pembimbing Akademik</label>
        <input type="text" name="pa" class="form-control" placeholder="Nama Dosen PA" value="<?= set_value('pa'); ?>">
        <?= form_error('pa', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <a class="btn btn-secondary" href="<?= base_url('bapendik/mahasiswa') ?>">Kembali</a>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>