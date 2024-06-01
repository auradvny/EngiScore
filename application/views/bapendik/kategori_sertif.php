<?= $this->session->flashdata('pesan'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="<?= base_url('bapendik/sertif_kategori'); ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategori">Tambah Kategori</a>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Sertifikat</a>
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

        <!-- Modal Kategori-->
        <div class="modal fade" id="newKategori" tabindex="-1" aria-labelledby="newKategoriLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newKategoriLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('bapendik/sertif_kategori'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Nama Kategori">
                                <?= form_error('kategori', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                            </div>
                        </div>
                        >
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>