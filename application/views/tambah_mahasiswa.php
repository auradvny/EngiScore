<form action="<?= base_url('mahasiswa/tambah_aksi') ?>" method="POST">
    <div class="form-group">
        <label for="nim_mhs">NIM Mahasiswa</label>
        <input type="text" name="nim_mhs" class="form-control">
        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="nama_mhs">Nama Mahasiswa</label>
        <input type="text" name="nama_mhs" class="form-control">
        <?= form_error('nama_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="email_mhs">Email Mahasiswa</label>
        <input type="email" name="email_mhs" class="form-control">
        <?= form_error('email_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="pass_mhs">Password Mahasiswa</label>
        <input type="text" name="pass_mhs" class="form-control">
        <?= form_error('pass_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="prodi_mhs">Prodi Mahasiswa</label>
        <input type="text" name="prodi_mhs" class="form-control">
        <?= form_error('prodi_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="jekel_mhs">Jenis Kelamin</label>
        <div>
            <input type="radio" name="jekel_mhs" value="L">Laki-Laki
            <input type="radio" name="jekel_mhs" value="P">Perempuan
        </div>
        <?= form_error('jekel_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="telp_mhs">No Telp Mahasiswa</label>
        <input type="text" name="telp_mhs" class="form-control">
        <?= form_error('telp_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="alamat_mhs">Alamat Mahasiswa</label>
        <textarea name="alamat_mhs" id="alamat_mhs" class="form-control"></textarea>
        <?= form_error('alamat_mhs', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Reset</button>
</form>