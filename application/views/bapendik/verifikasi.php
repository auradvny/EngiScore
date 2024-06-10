<div class="card-header">
    <a href="<?= base_url('bapendik/verif_setuju') ?>" class="btn btn-primary btn-sm"><i class="fas da-plus"></i>Permohonan Disetujui</a>
    <a href="<?= base_url('bapendik/verif_tolak') ?>" class="btn btn-primary btn-sm"><i class="fas da-plus"></i>Permohonan Ditolak</a>
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
                            <select name="persetujuan" id="persetujuan" class="form-control">
                                <option value="" selected>Pilih Persetujuan</option>
                                <option value="1" <?= $verif['persetujuan'] == 1 ? 'selected' : ''; ?>>Setuju</option>
                                <option value="2" <?= $verif['persetujuan'] == 2 ? 'selected' : ''; ?>>Tolak</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </td>
                    </tr>
            </tbody>
        <?php endforeach ?>
        </table>
    </form>
</div>