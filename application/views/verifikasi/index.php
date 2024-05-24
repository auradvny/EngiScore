<?= form_error('bidang', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('sertifikat/tambah') ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas da-plus"></i>Tambah Mahasiswa</a>
        <a href="<?= base_url('sertifikat/print') ?>" class="btn btn-info btn-sm"><i class="fas da-print"></i>Print</a>
        <!-- <a href="<?= base_url('sertifikat/pdf') ?>" class="btn btn-success btn-sm"><i class="fas da-file"></i>Export PDF</a> -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>PRODI</th>
                    <th>SKOR</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($verif as $v) : ?>
                <tbody>
                    <tr class="text-center">
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $s['nim']; ?></td>
                        <td><?= $s['nama']; ?></td>
                        <td><?= $s['email']; ?></td>
                        <td><?= $s['verifikasi']; ?></td>
                        <td><?= $s['skor']; ?></td>
                    </tr>
                </tbody>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>


</div>
<!-- ./wrapper -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

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
            <form action="<?= base_url('verifikasi'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="bidang" name="bidang" placeholder="Nama Bidang">
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