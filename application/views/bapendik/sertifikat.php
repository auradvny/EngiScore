<?= $this->session->flashdata('pesan'); ?>
<div class="row">
    <div class="col-lg-6">
        <!-- Tabel untuk Bidang -->
        <div class="mb-4">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBidangModal">Tambah Bidang</a>
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
                                <td>
                                    <a href="#" class="badge badge-warning editBidangLink" data-toggle="modal" data-target="#editBidangModal" data-id="<?= $b['id']; ?>" data-nama="<?= $b['bidang']; ?>">Edit</a>
                                    <!-- <a href="#" class="badge badge-warning editBidangLink" data-id="<?= $b['id']; ?>" data-nama="<?= $b['bidang']; ?>">Edit</a> <a href="<?= base_url('bapendik/delete_bidang/' . $b['id']); ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus bidang ini?');">Delete</a> -->
                                    <!-- <a href="" class="badge badge-warning editBidangBtn" data-toggle="modal" data-target="#editBidangModal" data-id="<?= $b['id']; ?>" data-nama="<?= $b['bidang']; ?>">Edit</a> -->
                                    <a href="<?= base_url('bapendik/delete_bidang/' . $b['id']); ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-4">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategoriModal">Tambah Kategori</a>
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
                                <a href="<?= base_url('bapendik/edit_kategori/' . $kat['id']); ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url('bapendik/delete_kategori/' . $kat['id']); ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-6">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newCapaianModal">Tambah Capaian</a>
        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Capaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($capaian as $cap) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $cap['capaian']; ?></td>
                            <td>
                                <a href="<?= base_url('bapendik/edit_capaian/' . $cap['id']); ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url('bapendik/delete_capaian/' . $cap['id']); ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSertifikatModal">Tambah Sertifikat</a>
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
                            <a href="<?= base_url('bapendik/edit_sertifikat/' . $sertif['id']); ?>" class="badge badge-warning">Edit</a>
                            <a href="<?= base_url('bapendik/delete_sertifikat/' . $sertif['id']); ?>" class="badge badge-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk menambahkan bidang baru -->
    <div class="modal fade" id="newBidangModal" tabindex="-1" aria-labelledby="newBidangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBidangModalLabel">Tambah Bidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('bapendik/tambah_bidang'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bidang">Nama Bidang</label>
                            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" required>
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

    <!-- Modal Edit Bidang -->
    <div class="modal fade" id="editBidangModal" tabindex="-1" role="dialog" aria-labelledby="editBidangModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('bapendik/edit_bidang'); ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBidangModalLabel">Edit Bidang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editBidang">Bidang</label>
                            <input type="text" class="form-control" id="editBidang" name="bidang" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal untuk menambahkan kategori baru -->
    <div class="modal fade" id="newKategoriModal" tabindex="-1" aria-labelledby="newKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newKategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('bapendik/tambah_kategori'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
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

    <!-- Modal untuk menambahkan Capaian baru -->
    <div class="modal fade" id="newCapaianModal" tabindex="-1" aria-labelledby="newCapaianModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newCapaianModalLabel">Tambah Capaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('bapendik/tambah_capaian'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_capaian">Nama Capaian</label>
                            <input type="text" class="form-control" id="nama_capaian" name="nama_capaian" required>
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

    <!-- Modal untuk edit kategori -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('bapendik/edit_kategori'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="value_kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk menambahkan sertifikat baru -->
    <div class="modal fade" id="newSertifikatModal" tabindex="-1" aria-labelledby="newSertifikatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSertifikatModalLabel">Tambah Sertifikat</h5>
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
                            <select name="capaian_id" id="capaian_id" class="form-control">
                                <option value="">Pilih Capaian</option>
                                <?php foreach ($capaian as $c) : ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['capaian']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
</div>

<script>
    // JavaScript untuk mengisi modal edit dengan data yang sesuai
    $(document).on('click', '.editBidangLink', function() {
        var id = $(this).data('id');
        var nama = $(this).data('bidang');
        $('#editId').val(id); // Mengisi nilai id bidang di dalam input hidden
        $('#editBidang').val(nama); // Mengisi nilai nama bidang di dalam input teks
    });
</script>