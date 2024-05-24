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
                    <th>BIDANG</th>
                    <th>WUJUD CAPAIAN</th>
                    <th>KATEGORI</th>
                    <th>SKOR</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($sertif as $s) : ?>
                <tbody>
                    <tr class="text-center">
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $s['bidang']; ?></td>
                        <td><?= $s['capaian']; ?></td>
                        <td><?= $s['kategori']; ?></td>
                        <td><?= $s['skor']; ?></td>
                        <td>
                            <a href="" class="badge badge-success">Edit</a>
                            <a href="" class="badge badge-danger">Delete</a>
                        </td>
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
            <form action="<?= base_url('sertifikat'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="bidang" name="bidang" placeholder="Nama Bidang">
                    </div>
                    <div class="form-group">
                        <select name="" id=""></select>
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