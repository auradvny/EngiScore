<div class="card-header">
    <a href="<?= base_url('bapendik/verifikasi') ?>" class="btn btn-primary btn-sm"><i class="fas da-plus"></i>Kembali</a>
</div>
<div class="card-body">
    <form action="<?= base_url('bapendik/tambah_verif'); ?>" method="POST">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Bidang</th>
                    <th>Kategori</th>
                    <th>Capaian</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($verifikasi as $verif) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $verif['nim_mhs']; ?></td>
                        <td><?= $verif['bidang']; ?></td>
                        <td><?= $verif['kategori']; ?></td>
                        <td><?= $verif['capaian']; ?></td>
                        <td><?= $verif['file']; ?></td>
                    </tr>
            </tbody>
        <?php endforeach ?>
        </table>
    </form>
</div>