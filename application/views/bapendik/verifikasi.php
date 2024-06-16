<div class="card-header">
    <a href="<?= base_url('bapendik/verif_setuju') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Permohonan Disetujui</a>
    <a href="<?= base_url('bapendik/verif_tolak') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Permohonan Ditolak</a>
</div>
<div class="card-body">
    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

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
                    <th>Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($verifikasi as $verif) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $verif['nim_mhs']; ?></td>
                        <td><?= $verif['bidang_id']; ?></td>
                        <td><?= $verif['kategori_id']; ?></td>
                        <td><?= $verif['capaian_id']; ?></td>
                        <td><?= $verif['file']; ?></td>
                        <td>
                            <input type="radio" name="persetujuan" value="1" <?= $verif['persetujuan'] == 1 ? 'checked' : ''; ?>> Setuju
                            <input type="radio" name="persetujuan" value="2" <?= $verif['persetujuan'] == 2 ? 'checked' : ''; ?>> Tolak
                        </td>
                        <td>
                            <input type="hidden" name="nim_mhs" value="<?= $verif['nim_mhs']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
