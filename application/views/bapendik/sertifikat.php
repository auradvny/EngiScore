<div class="row">
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">
        <div class="col-lg-6">
            <a href=" <?= base_url('bapendik/sertif_kategori'); ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategori">Tambah Bidang</a>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Bidang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($bidang as $b) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $b['bidang']; ?></td>
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

        <div class="col-lg-6">
            <a href=" <?= base_url('bapendik/sertif_kategori'); ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategori">Tambah Kategori</a>
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kategori as $kat) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $kat['kategori']; ?></td>
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
        <div class="col-lg-12">
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



    <!-- Modal Sertifikat-->
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
                            <label for="bidang_id">Bidang</label>
                            <div class="form-group">
                                <select name="bidang_id" id="bidang_id" class="form-control">
                                    <option value="">Pilih Bidang</option>
                                    <?php foreach ($bidang as $b) : ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['bidang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('bidang', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="capaian">Capaian</label>
                            <input type="text" class="form-control" id="capaian" name="capaian" placeholder="Nama Capaian">
                            <?= form_error('capaian', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <div class="form-group">
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('kategori_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="skor">Skor</label>
                            <input type="number" class="form-control" id="skor" name="skor">
                            <?= form_error('skor', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
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