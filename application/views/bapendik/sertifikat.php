<?= $this->session->flashdata('pesan'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Sertifikat</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Bidang</th>
                    <th scope="col">Capaian</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Skor</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($sertifikat as $sertif) : ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $sertif['bidang']; ?></td>
                        <td><?= $sertif['capaian']; ?></td>
                        <td><?= $sertif['kategori']; ?></td>
                        <td><?= $sertif['skor']; ?></td>
                        <td>
                            <a href="" class="badge badge-warning">Edit</a>
                            <a href="" class="badge badge-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sertifikat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bapendik/sertifikat'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bidang">Bidang</label>
                        <input type="text" class="form-control" id="bidang" name="bidang" placeholder="Nama Bidang">
                        <?= form_error('bidang', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="capaian">Capaian</label>
                        <input type="text" class="form-control" id="capaian" name="capaian" placeholder="Nama Capaian">
                        <?= form_error('capaian', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="A">Internasional</option>
                            <option value="B">Regional</option>
                            <option value="C">Nasional</option>
                            <option value="D">Provisi</option>
                            <option value="E">Kab/Kota/PT/Fak</option>
                        </select>
                        <?= form_error('kategori', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="capaian">Skor</label>
                        <input type="number" class="form-control" id="skor" name="skor">
                        <?= form_error('skor', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>