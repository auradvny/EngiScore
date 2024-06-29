<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('bapendik/tambah_mhs') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Mahasiswa
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>Point</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($mahasiswa as $mhs) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $mhs['nim_mhs']; ?></td>
                        <td><?= $mhs['nama']; ?></td>
                        <td><?= $mhs['email']; ?></td>
                        <td><?= $mhs['gender']; ?></td>
                        <td><?= $mhs['prodi']; ?></td>
                        <td><?= $mhs['telp']; ?></td>
                        <td><?= $mhs['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td><?= $mhs['point']; ?></td>
                        <td>
                            <a href="<?= base_url('bapendik/edit_mhs/' . $mhs['user_id']) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('bapendik/hapusMahasiswa/' . $mhs['user_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($mahasiswa as $mhs) : ?>
    <div class="modal fade" id="edit<?= $mhs['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('bapendik/edit_mhs/' . $mhs['user_id']) ?>" method="POST">
                        <div class="form-group">
                            <label for="nim_mhs">NIM Mahasiswa</label>
                            <input type="text" name="nim_mhs" class="form-control" value='<?= $mhs['nim_mhs'] ?>' readonly>
                            <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" name="nama" class="form-control" value='<?= $mhs['nama'] ?>'>
                            <?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Mahasiswa</label>
                            <input type="email" name="email" class="form-control" value='<?= $mhs['email'] ?>'>
                            <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password Mahasiswa</label>
                            <input type="text" name="pass" class="form-control" value='<?= $mhs['pass'] ?>'>
                            <?= form_error('pass', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi Mahasiswa</label>
                            <input type="text" name="prodi" class="form-control" value='<?= $mhs['prodi'] ?>'>
                            <?= form_error('prodi', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <div>
                                <input type="radio" name="gender" value="L" <?= $mhs['gender'] == 'L' ? 'checked' : '' ?>> Laki-Laki
                                <input type="radio" name="gender" value="P" <?= $mhs['gender'] == 'P' ? 'checked' : '' ?>> Perempuan
                            </div>
                            <?= form_error('gender', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp Mahasiswa</label>
                            <input type="text" name="telp" class="form-control" value='<?= $mhs['telp'] ?>'>
                            <?= form_error('telp', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Mahasiswa</label>
                            <textarea name="alamat" id="alamat" class="form-control"><?= $mhs['alamat'] ?></textarea>
                            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>