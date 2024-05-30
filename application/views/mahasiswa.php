<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('mahasiswa/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Mahasiswa</a>
        <a href="<?= base_url('mahasiswa/print') ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print</a>
        <a href="<?= base_url('mahasiswa/pdf') ?>" class="btn btn-success btn-sm"><i class="fas fa-file"></i> Export PDF</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Prodi</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($mahasiswa as $mhs): ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $mhs->nim_mhs ?></td>
                    <td><?= $mhs->nama_mhs ?></td>
                    <td><?= $mhs->email_mhs ?></td>
                    <td><?= $mhs->pass_mhs ?></td>
                    <td><?= $mhs->prodi_mhs ?></td>
                    <td><?= $mhs->jekel_mhs ?></td>
                    <td><?= $mhs->telp_mhs ?></td>
                    <td><?= $mhs->alamat_mhs ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $mhs->nim_mhs ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <a href="<?= base_url('mahasiswa/delete/' . $mhs->nim_mhs) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
 


<!-- Modal Edit -->
<?php foreach($mahasiswa as $mhs) : ?>
<div class="modal fade" id="edit<?= $mhs->nim_mhs ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('mahasiswa/edit/'. $mhs->nim_mhs) ?>" method="POST">
                    <div class="form-group">
                        <label for="nim_mhs">NIM Mahasiswa</label>
                        <input type="text" name="nim_mhs" class="form-control" value='<?= $mhs->nim_mhs ?>' readonly>
                        <?= form_error('nim_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_mhs">Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" class="form-control" value='<?= $mhs->nama_mhs ?>'>
                        <?= form_error('nama_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email_mhs">Email Mahasiswa</label>
                        <input type="email" name="email_mhs" class="form-control" value='<?= $mhs->email_mhs ?>'>
                        <?= form_error('email_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="pass_mhs">Password Mahasiswa</label>
                        <input type="text" name="pass_mhs" class="form-control" value='<?= $mhs->pass_mhs ?>'>
                        <?= form_error('pass_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="prodi_mhs">Prodi Mahasiswa</label>
                        <input type="text" name="prodi_mhs" class="form-control" value='<?= $mhs->prodi_mhs ?>'>
                        <?= form_error('prodi_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jekel_mhs">Jenis Kelamin</label>
                        <div>
                            <input type="radio" name="jekel_mhs" value="L" <?= $mhs->jekel_mhs == 'L' ? 'checked' : '' ?> >Laki-Laki
                            <input type="radio" name="jekel_mhs" value="P" <?= $mhs->jekel_mhs == 'P' ? 'checked' : '' ?> >Perempuan
                        </div>
                        <?= form_error('jekel_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="telp_mhs">No Telp Mahasiswa</label>
                        <input type="text" name="telp_mhs" class="form-control" value='<?= $mhs->telp_mhs ?>'>
                        <?= form_error('telp_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat_mhs">Alamat Mahasiswa</label>
                        <textarea name="alamat_mhs" id="alamat_mhs" class="form-control"><?= $mhs->alamat_mhs ?></textarea>
                        <?= form_error('alamat_mhs', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>