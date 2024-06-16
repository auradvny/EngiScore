<form action="<?= base_url('bapendik/update_mhs') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']; ?>">
        <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email">Email Mahasiswa</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $mahasiswa['email']; ?>">
        <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" class="form-control" id="nim_mhs" name="nim_mhs" value="<?= $mahasiswa['nim_mhs']; ?>" readonly>
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <div>
            <input type="radio" name="gender" value="L" <?= $mahasiswa['gender'] == 'L' ? 'checked' : ''; ?>> Laki-Laki
            <input type="radio" name="gender" value="P" <?= $mahasiswa['gender'] == 'P' ? 'checked' : ''; ?>> Perempuan
        </div>
        <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="prodi_id">Prodi Mahasiswa</label>
        <select name="prodi_id" id="prodi_id" class="form-control">
            <option value="">Pilih Prodi</option>
            <?php foreach ($prodi as $p) : ?>
                <option value="<?= $p['id']; ?>" <?= $mahasiswa['prodi_id'] == $p['id'] ? 'selected' : ''; ?>><?= $p['prodi']; ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('prodi_id', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp">No Telp Mahasiswa</label>
        <input type="text" class="form-control" id="telp" name="telp" value="<?= $mahasiswa['telp']; ?>">
        <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="image">Gambar</label>
        <input type="file" class="form-control" id="image" name="image">
        <img src="<?= base_url('assets/img/profile/') . $mahasiswa['image']; ?>" alt="current image" width="100">
        <?= form_error('image', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pembiayaan">Pembiayaan</label>
        <select name="pembiayaan" id="pembiayaan" class="form-control">
            <option value="biaya_sendiri" <?= $mahasiswa['pembiayaan'] == 'biaya_sendiri' ? 'selected' : ''; ?>>Biaya Sendiri</option>
            <option value="pemerintah" <?= $mahasiswa['pembiayaan'] == 'pemerintah' ? 'selected' : ''; ?>>Pemerintah</option>
        </select>
        <?= form_error('pembiayaan', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pa">Pembimbing Akademik</label>
        <input type="text" class="form-control" id="pa" name="pa" value