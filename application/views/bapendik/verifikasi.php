<div class="card-header">
    <a href="<?= base_url('bapendik/verif_setuju') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Permohonan Disetujui</a>
    <a href="<?= base_url('bapendik/verif_tolak') ?>" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i> Permohonan Ditolak</a>
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
                        <td><?= $verif['bidang']; ?></td>
                        <td><?= $verif['kategori']; ?></td>
                        <td><?= $verif['capaian']; ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalGambar<?= $verif['id']; ?>">
                                <img src="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" alt="Sertifikat" style="width:100px; height:auto;">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="modalGambar<?= $verif['id']; ?>" tabindex="-1" aria-labelledby="modalGambarLabel<?= $verif['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalGambarLabel<?= $verif['id']; ?>">Sertifikat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" alt="Sertifikat" style="width:100%; height:auto;">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" class="btn btn-primary" download>Unduh</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- <td>
                            <img src="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" alt="Sertifikat" style="width:100px; height:auto;">
                        </td> -->
                        <td>
                            <input type="radio" name="persetujuan[<?= $verif['id']; ?>]" value="1" <?= $verif['persetujuan'] == 1 ? 'checked' : ''; ?>> Setuju
                            <input type="radio" name="persetujuan[<?= $verif['id']; ?>]" value="2" <?= $verif['persetujuan'] == 2 ? 'checked' : ''; ?>> Tolak
                        </td>
                        <td>
                            <input type="hidden" name="id[]" value="<?= $verif['id']; ?>">
                            <input type="hidden" name="nim_mhs[<?= $verif['id']; ?>]" value="<?= $verif['nim_mhs']; ?>">
                            <input type="hidden" name="bidang_id[<?= $verif['id']; ?>]" value="<?= $verif['bidang_id']; ?>">
                            <input type="hidden" name="kategori_id[<?= $verif['id']; ?>]" value="<?= $verif['kategori_id']; ?>">
                            <input type="hidden" name="capaian_id[<?= $verif['id']; ?>]" value="<?= $verif['capaian_id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>