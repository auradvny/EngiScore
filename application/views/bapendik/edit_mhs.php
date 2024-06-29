<form action="<?= base_url('bapendik/update_mhs/' . $mahasiswa['user_id']) ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?= isset($mahasiswa['user_id']) ? $mahasiswa['user_id'] : ''; ?>">
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', isset($mahasiswa['nama']) ? $mahasiswa['nama'] : ''); ?>" readonly>
        <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email">Email Mahasiswa</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email', isset($mahasiswa['email']) ? $mahasiswa['email'] : ''); ?>" readonly>
        <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" class="form-control" id="nim_mhs" name="nim_mhs" value="<?= isset($mahasiswa['nim_mhs']) ? $mahasiswa['nim_mhs'] : ''; ?>" readonly>
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <div>
            <input type="radio" name="gender" value="L" <?= isset($mahasiswa['gender']) && $mahasiswa['gender'] == 'L' ? 'checked' : ''; ?>> Laki-Laki
            <input type="radio" name="gender" value="P" <?= isset($mahasiswa['gender']) && $mahasiswa['gender'] == 'P' ? 'checked' : ''; ?>> Perempuan
        </div>
        <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="prodi_id">Prodi Mahasiswa</label>
        <select name="prodi_id" id="prodi_id" class="form-control">
            <option value="">Pilih Prodi</option>
            <?php foreach ($prodi as $p) : ?>
                <option value="<?= $p['id']; ?>" <?= isset($mahasiswa['prodi_id']) && $mahasiswa['prodi_id'] == $p['id'] ? 'selected' : ''; ?>><?= $p['prodi']; ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('prodi_id', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp">No Telepon Mahasiswa</label>
        <input type="text" class="form-control" id="telp" name="telp" value="<?= set_value('telp', isset($mahasiswa['telp']) ? $mahasiswa['telp'] : ''); ?>">
        <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="image">Profile Mahasiswa</label><br>
        <?php if (isset($mahasiswa['image']) && !empty($mahasiswa['image'])) : ?>
            <img src="<?= base_url('assets/img/profile/') . $mahasiswa['image']; ?>" alt="current image" width="100">
        <?php endif; ?>
        <input type="file" class="form-control" id="image" name="image">
        <?= form_error('image', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pembiayaan">Pembiayaan</label>
        <select name="pembiayaan" id="pembiayaan" class="form-control">
            <option value="biaya_sendiri" <?= isset($mahasiswa['pembiayaan']) && $mahasiswa['pembiayaan'] == 'biaya_sendiri' ? 'selected' : ''; ?>>Biaya Sendiri</option>
            <option value="pemerintah" <?= isset($mahasiswa['pembiayaan']) && $mahasiswa['pembiayaan'] == 'pemerintah' ? 'selected' : ''; ?>>Pemerintah</option>
        </select>
        <?= form_error('pembiayaan', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pa">Pembimbing Akademik</label>
        <input type="text" name="pa" class="form-control" value="<?= set_value('pa', isset($mahasiswa['pa']) ? $mahasiswa['pa'] : ''); ?>">
        <?= form_error('pa', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="point">Point</label>
        <input type="text" name="point" class="form-control" value="<?= set_value('point', isset($mahasiswa['point']) ? $mahasiswa['point'] : ''); ?>" readonly>
        <?= form_error('point', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <a class="btn btn-secondary btn-sm" href="<?= base_url('bapendik/mahasiswa') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>