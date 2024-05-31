<form action="<?= base_url('bapendik/tambah_aksi') ?>" method="POST">
    <!-- tb_mhs (nim_mhs) dari tb_user(user_id) -->
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" name="nim_mhs" class="form-control">
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" name="nama" class="form-control">
        <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email">Email Mahasiswa</label>
        <input type="email" name="email" class="form-control">
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
            <input type="radio" name="gender" value="L">Laki-Laki
            <input type="radio" name="gender" value="P">Perempuan
        </div>
        <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <!-- tb_mhs (prodi_id) dari tb_prodi -->
    <div class="form-group">
        <label for="prodi">Prodi Mahasiswa</label>
        <input type="text" name="prodi" class="form-control">
        <?= form_error('prodi', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp">No Telp Mahasiswa</label>
        <input type="text" name="telp" class="form-control">
        <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat Mahasiswa</label>
        <textarea name="alamat" id="alamat" class="form-control"></textarea>
        <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Reset</button>
</form>